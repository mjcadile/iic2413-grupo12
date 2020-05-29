CREATE OR REPLACE FUNCTION itinerario(
    ciudad_origen INT,
    intervalo INT,
    fecha DATE,
    artistas VARCHAR(255)[]
)
RETURNS void AS $$

DECLARE
    viaje_1 RECORD;
    viaje_2 RECORD;
    viaje_3 RECORD;
    hora_aux TIME;
    itin RECORD;

    artista RECORD;
    art VARCHAR(255);
    artistas_id INT[];

    obra RECORD;
    obras_id INT[];

    obra_ RECORD;
    lugares_id INT[];

    lugar RECORD;
    ciudades_id INT[];
    ciudades_nombre VARCHAR(255)[];

    destinos_itin RECORD;
    destinos RECORD;
    destinos_2 RECORD;
    destinos_3 RECORD;
    destinos_borrar INT[];

    fechas DATE[];
    fechas_llegada DATE[];

    contador INT;

BEGIN
    DROP TABLE IF EXISTS Itinerario;
    CREATE TABLE Itinerario(did_1 INT, did_2 INT, did_3 INT);

    FOR viaje_1 IN (SELECT did, origen, destino, hora, duracion
                    FROM Destinos)
    LOOP
        IF (viaje_1.origen = ciudad_origen) THEN
	    INSERT INTO Itinerario VALUES(viaje_1.did, NULL, NULL);
            
            FOR viaje_2 IN (SELECT did, origen, destino, hora, duracion
                            FROM Destinos)
            LOOP
                IF (viaje_1.destino = viaje_2.origen AND viaje_1.origen <> viaje_2.destino) THEN
                    hora_aux = viaje_1.hora + viaje_1.duracion * interval '1 hour';
                    IF (viaje_2.hora - hora_aux > time '00:00') THEN
                        IF (viaje_2.hora - hora_aux < intervalo * interval '1 hour') THEN
                            INSERT INTO Itinerario VALUES(viaje_1.did, viaje_2.did, NULL);
                            
                            FOR viaje_3 IN (SELECT did, origen, destino, hora, duracion
                                            FROM Destinos)
                            LOOP
                                IF (viaje_2.destino = viaje_3.origen AND viaje_1.origen <> viaje_3.destino AND viaje_2.origen <> viaje_3.destino) THEN
                                    hora_aux = viaje_2.hora + viaje_2.duracion * interval '1 hour';
                                    IF (viaje_3.hora - hora_aux > time '00:00') THEN
                                        IF (viaje_3.hora - hora_aux < intervalo * interval '1 hour') THEN
                                            INSERT INTO Itinerario VALUES(viaje_1.did, viaje_2.did, viaje_3.did);
                                        END IF;
                                    ELSE
                                        IF ((time '24:00' - (hora_aux - viaje_3.hora)) < intervalo * interval '1 hour') THEN
                                            INSERT INTO Itinerario VALUES(viaje_1.did, viaje_2.did, viaje_3.did);
                                        END IF;
                                    END IF;
                                END IF;
                            END LOOP;
                        END IF;
                    ELSE 
                        IF ((time '24:00' - (hora_aux - viaje_2.hora)) < intervalo * interval '1 hour') THEN
                            INSERT INTO Itinerario VALUES(viaje_1.did, viaje_2.did, NULL);
                            
                            FOR viaje_3 IN (SELECT did, origen, destino, hora, duracion
                                            FROM Destinos)
                            LOOP
                                IF (viaje_2.destino = viaje_3.origen AND viaje_1.origen <> viaje_3.destino AND viaje_2.origen <> viaje_3.destino) THEN
                                    hora_aux = viaje_2.hora + viaje_2.duracion * interval '1 hour';
                                    IF (viaje_3.hora - hora_aux > time '00:00') THEN
                                        IF (viaje_3.hora - hora_aux < intervalo * interval '1 hour') THEN
                                            INSERT INTO Itinerario VALUES(viaje_1.did, viaje_2.did, viaje_3.did);
                                        END IF;
                                    ELSE
                                        IF ((time '24:00' - (hora_aux - viaje_3.hora)) < intervalo * interval '1 hour') THEN
                                            INSERT INTO Itinerario VALUES(viaje_1.did, viaje_2.did, viaje_3.did);
                                        END IF;
                                    END IF;
                                END IF;
                            END LOOP;
                        END IF;
                    END IF;
                END IF;
            END LOOP;
        END IF;
    END LOOP;
    
    contador = 1;
    FOREACH art IN ARRAY artistas
    LOOP
        FOR artista IN (SELECT * FROM dblink('dbname=grupo12e3 user=grupo12 password=grupo12', 'SELECT aid, nombre FROM Artistas') 
                                   AS Artistas(aid INT, nombre VARCHAR(255)))
        LOOP
            IF (artista.nombre = art) THEN
                artistas_id[contador] = artista.aid;
                contador = contador + 1;
            END IF;
        END LOOP;
    END LOOP;

    contador = 1;
    FOR obra IN (SELECT * FROM dblink('dbname=grupo12e3 user=grupo12 password=grupo12', 'SELECT oid, aid FROM Hecha_por') 
                            AS Hecha_por(oid INT, aid INT))
    LOOP
        IF (ARRAY[obra.aid] <@ artistas_id) THEN
            obras_id[contador] = obra.oid;
            contador = contador + 1;
        END IF;
    END LOOP;

    contador = 1;
    FOR obra_ IN (SELECT * FROM dblink('dbname=grupo12e3 user=grupo12 password=grupo12', 'SELECT oid, lid FROM Obras') 
                            AS Obras(oid INT, lid INT))
    LOOP
        IF (ARRAY[obra_.oid] <@ obras_id) THEN
            lugares_id[contador] = obra_.lid;
            contador = contador + 1;
        END IF;
    END LOOP;

    contador = 1;
    FOR lugar IN (SELECT * FROM dblink('dbname=grupo12e3 user=grupo12 password=grupo12', 'SELECT lid, cid FROM Lugares') 
                            AS Lugares(lid INT, cid INT))
    LOOP
        IF (ARRAY[lugar.lid] <@ lugares_id) THEN
            IF (ARRAY[lugar.cid] <@ ciudades_id) THEN
                contador = contador;
            ELSE
                ciudades_id[contador] = lugar.cid;
                contador = contador + 1;
            END IF;
        END IF;
    END LOOP;


    FOR destinos_itin IN (SELECT did_1, did_2, did_3 FROM Itinerario)
    LOOP
        IF (destinos_itin.did_3 IS NOT NULL) THEN
            FOR destinos IN (SELECT did, destino FROM Destinos)
            LOOP
                IF (destinos_itin.did_3 = destinos.did) THEN
                    IF (ARRAY[destinos.destino] <@ ciudades_id) THEN
                        contador = contador;
                    ELSE
                        DELETE FROM Itinerario
                        WHERE did_1 = destinos_itin.did_1 AND did_2 = destinos_itin.did_2 AND did_3 = destinos_itin.did_3;
                    END IF;
                END IF;
            END LOOP;
        END IF;

        IF (destinos_itin.did_2 IS NOT NULL AND destinos_itin.did_3 IS NULL) THEN
            FOR destinos IN (SELECT did, destino FROM Destinos)
            LOOP
                IF (destinos_itin.did_2 = destinos.did) THEN
                    IF (ARRAY[destinos.destino] <@ ciudades_id) THEN
                        contador = contador;
                    ELSE
                        DELETE FROM Itinerario
                        WHERE did_1 = destinos_itin.did_1 AND did_2 = destinos_itin.did_2 AND did_3 IS NULL;
                    END IF;
                END IF;
            END LOOP;
        END IF;

        IF (destinos_itin.did_1 IS NOT NULL AND destinos_itin.did_2 IS NULL AND destinos_itin.did_3 IS NULL) THEN
            FOR destinos IN (SELECT did, destino FROM Destinos)
            LOOP
                IF (destinos_itin.did_1 = destinos.did) THEN
                    IF (ARRAY[destinos.destino] <@ ciudades_id) THEN
                        contador = contador;
                    ELSE
                        DELETE FROM Itinerario
                        WHERE did_1 = destinos_itin.did_1 AND did_2 IS NULL AND did_3 IS NULL;
                    END IF;
                END IF;
            END LOOP;
        END IF;
    END LOOP;


    DROP TABLE IF EXISTS Itinerario_final;
    CREATE TABLE Itinerario_final(ciudad_1 VARCHAR(255), ciudad_2 VARCHAR(255), ciudad_3 VARCHAR(255), ciudad_4 VARCHAR(255),
                                  hora_1 TIME, hora_2 TIME, hora_3 TIME, hora_llegada_1 TIME, hora_llegada_2 TIME, hora_llegada_3 TIME,
                                  fecha_1 DATE, fecha_2 DATE, fecha_3 DATE, fecha_llegada_1 DATE, fecha_llegada_2 DATE, fecha_llegada_3 DATE,
                                  medio_1 VARCHAR(255), medio_2 VARCHAR(255), medio_3 VARCHAR(255),
                                  precio_1 INT, precio_2 INT, precio_3 INT, precio_total INT);

    FOR destinos_itin IN (SELECT did_1, did_2, did_3 FROM Itinerario)
    LOOP
        IF (destinos_itin.did_1 IS NOT NULL AND destinos_itin.did_2 IS NOT NULL AND destinos_itin.did_3 IS NOT NULL) THEN
            FOR destinos IN (SELECT * FROM Destinos)
            LOOP
                IF (destinos.did = destinos_itin.did_1) THEN
                    FOR destinos_2 IN (SELECT * FROM Destinos)
                    LOOP
                        IF (destinos_2.did = destinos_itin.did_2) THEN
                            FOR destinos_3 IN (SELECT * FROM Destinos)
                            LOOP
                                IF (destinos_itin.did_3 = destinos_3.did) THEN
                                    FOR lugar IN (SELECT cid, nombre_ciudad FROM Ciudades)
                                    LOOP
                                        IF (lugar.cid = destinos.origen) THEN
                                            ciudades_nombre[1] = lugar.nombre_ciudad;
                                        END IF;
                                        IF (lugar.cid = destinos.destino) THEN
                                            ciudades_nombre[2] = lugar.nombre_ciudad;
                                        END IF;
                                        IF (lugar.cid = destinos_2.destino) THEN
                                            ciudades_nombre[3] = lugar.nombre_ciudad;
                                        END IF;
                                        IF (lugar.cid = destinos_3.destino) THEN
                                            ciudades_nombre[4] = lugar.nombre_ciudad;
                                        END IF;
                                    END LOOP;


                                    IF (CURRENT_TIME > destinos.hora AND CURRENT_DATE = fecha) THEN
                                        fechas[1] = fecha + interval '1 day';
                                    ELSE
                                        fechas[1] = fecha;
                                    END IF;
                                    IF (destinos.hora + destinos.duracion * interval '1 hour' < destinos_2.hora) THEN
                                        fechas[2] = fechas[1];
                                    ELSE
                                        fechas[2] = fechas[1] + interval '1 day';
                                    END IF;

                                    IF (destinos_2.hora + destinos_2.duracion * interval '1 hour' < destinos_3.hora) THEN
                                        fechas[3] = fechas[2];
                                    ELSE
                                        fechas[3] = fechas[2] + interval '1 day';
                                    END IF;


                                    IF (destinos.hora + destinos.duracion * interval '1 hour' < destinos.hora) THEN
                                        fechas_llegada[1] = fechas[1] + interval '1 day';
                                    ELSE
                                        fechas_llegada[1] = fechas[1];
                                    END IF;

                                    IF (destinos_2.hora + destinos.duracion * interval '1 hour' < destinos_2.hora) THEN
                                        fechas_llegada[2] = fechas[2] + interval '1 day';
                                    ELSE
                                        fechas_llegada[2] = fechas[2];
                                    END IF;

                                    IF (destinos_3.hora + destinos.duracion * interval '1 hour' < destinos_3.hora) THEN
                                        fechas_llegada[3] = fechas[3] + interval '1 day';
                                    ELSE
                                        fechas_llegada[3] = fechas[3];
                                    END IF;

                                    INSERT INTO Itinerario_final 
                                    VALUES(ciudades_nombre[1], ciudades_nombre[2], ciudades_nombre[3], ciudades_nombre[4],
                                           destinos.hora, destinos_2.hora, destinos_3.hora,
                                           destinos.hora + destinos.duracion * interval '1 hour',
                                           destinos_2.hora + destinos_2.duracion * interval '1 hour',
                                           destinos_3.hora + destinos_3.duracion * interval '1 hour',
                                           fechas[1], fechas[2], fechas[3], fechas_llegada[1], fechas_llegada[2], fechas_llegada[3],
                                           destinos.medio, destinos_2.medio, destinos_3.medio,
                                           destinos.precio_destino, destinos_2.precio_destino, destinos_3.precio_destino,
                                           destinos.precio_destino + destinos_2.precio_destino + destinos_3.precio_destino);
                                END IF;
                            END LOOP;
                        END IF;
                    END LOOP;
                END IF;
            END LOOP;

        ELSEIF (destinos_itin.did_1 IS NOT NULL AND destinos_itin.did_2 IS NOT NULL) THEN
            FOR destinos IN (SELECT * FROM Destinos)
            LOOP
                IF (destinos.did = destinos_itin.did_1) THEN
                    FOR destinos_2 IN (SELECT * FROM Destinos)
                    LOOP
                        IF (destinos_itin.did_2 = destinos_2.did) THEN
                            FOR lugar IN (SELECT cid, nombre_ciudad FROM Ciudades)
                            LOOP
                                IF (lugar.cid = destinos.origen) THEN
                                    ciudades_nombre[1] = lugar.nombre_ciudad;
                                END IF;
                                IF (lugar.cid = destinos.destino) THEN
                                    ciudades_nombre[2] = lugar.nombre_ciudad;
                                END IF;
                                IF (lugar.cid = destinos_2.destino) THEN
                                    ciudades_nombre[3] = lugar.nombre_ciudad;
                                END IF;
                            END LOOP;

                            IF (CURRENT_TIME > destinos.hora AND CURRENT_DATE = fecha) THEN
                                fechas[1] = fecha + interval '1 day';
                            ELSE
                                fechas[1] = fecha;
                            END IF;
                            IF (destinos.hora + destinos.duracion * interval '1 hour' < destinos_2.hora) THEN
                                fechas[2] = fechas[1];
                            ELSE
                                fechas[2] = fechas[1] + interval '1 day';
                            END IF;


                            IF (destinos.hora + destinos.duracion * interval '1 hour' < destinos.hora) THEN
                                fechas_llegada[1] = fechas[1] + interval '1 day';
                            ELSE
                                fechas_llegada[1] = fechas[1];
                            END IF;

                            IF (destinos_2.hora + destinos.duracion * interval '1 hour' < destinos_2.hora) THEN
                                fechas_llegada[2] = fechas[2] + interval '1 day';
                            ELSE
                                fechas_llegada[2] = fechas[2];
                            END IF;

                            INSERT INTO Itinerario_final 
                            VALUES(ciudades_nombre[1], ciudades_nombre[2], ciudades_nombre[3], NULL,
                                   destinos.hora, destinos_2.hora, NULL,
                                   destinos.hora + destinos.duracion * interval '1 hour',
                                   destinos_2.hora + destinos_2.duracion * interval '1 hour',
                                   NULL,
                                   fechas[1], fechas[2], NULL, fechas_llegada[1], fechas_llegada[2], NULL,
                                   destinos.medio, destinos_2.medio, NULL,
                                   destinos.precio_destino, destinos_2.precio_destino, NULL,
                                   destinos.precio_destino + destinos_2.precio_destino);
                        END IF;

                    END LOOP;
                END IF;
            END LOOP;
        ELSE
            FOR destinos IN (SELECT * FROM Destinos)
            LOOP
                IF (destinos_itin.did_1 = destinos.did) THEN
                    FOR lugar IN (SELECT cid, nombre_ciudad FROM Ciudades)
                    LOOP
                        IF (lugar.cid = destinos.origen) THEN
                            ciudades_nombre[1] = lugar.nombre_ciudad;
                        END IF;
                        IF (lugar.cid = destinos.destino) THEN
                            ciudades_nombre[2] = lugar.nombre_ciudad;
                        END IF;
                    END LOOP;

                    IF (CURRENT_TIME > destinos.hora AND CURRENT_DATE = fecha) THEN
                        fechas[1] = fecha + interval '1 day';
                    ELSE
                        fechas[1] = fecha;
                    END IF;

                    IF (destinos.hora + destinos.duracion * interval '1 hour' < destinos.hora) THEN
                        fechas_llegada[1] = fechas[1] + interval '1 day';
                    ELSE
                        fechas_llegada[1] = fechas[1];
                    END IF;

                    INSERT INTO Itinerario_final 
                    VALUES(ciudades_nombre[1], ciudades_nombre[2], NULL, NULL,
                           destinos.hora, NULL, NULL,
                           destinos.hora + destinos.duracion * interval '1 hour',
                           NULL,
                           NULL,
                           fechas[1], NULL, NULL, fechas_llegada[1], NULL, NULL,
                           destinos.medio, NULL, NULL,
                           destinos.precio_destino, NULL, NULL,
                           destinos.precio_destino);
                END IF;
            END LOOP;
        END IF;
    END LOOP;
END;
$$ LANGUAGE plpgsql