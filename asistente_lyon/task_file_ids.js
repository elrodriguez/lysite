import express from "express";
const app = express();
import mysql from 'mysql2';
app.use(express.json());

import * as dotenv from "dotenv";
import { OpenAI } from "openai";

dotenv.config();

const openai = new OpenAI({
  apiKey: process.env.OPENAI_API_KEY,
});

// Función principal asincrónica
async function main() {
  try {
    await file_ids_deleting();

    console.log('Conexión cerrada');
    console.log('Archivos Eliminados de OPENAI exitosamente...');
    process.exit(0); // Salir del proceso con éxito
  } catch (error) {
    console.error('Error al eliminar los archivos: ' + error);
    process.exit(1); // Salir del proceso con un código de error
  }
}

main();

// FUNCION PARA BUSQUEDA DE ARCHIVOS NO ELIMINADOS DE OPENAI
function file_ids_deleting() {
  return new Promise((resolve, reject) => {
    const connection = mysql.createConnection({
      host: process.env.DB_HOST,
      user: process.env.DB_USER,
      password: process.env.DB_PASWORD,
      database: process.env.DB_DATABASE_NAME
    });

    const selectQuery = 'SELECT * FROM assistant_gpt_files_ids WHERE deleted = ? AND TIMESTAMPDIFF(HOUR, created_at, NOW()) >= 2';
    const deletedValue = false;

    connection.query(selectQuery, [deletedValue], (error, results) => {
      if (error) {
        reject(error); // Rechazar la promesa en caso de error
        return;
      }

      console.log('Filas encontradas:');
      console.log(results);
      const promises = results.map(item => {
        return delete_fileID(item.id)
          .then(() => updateDeletedStatus(item.id));
      });

      Promise.all(promises)
        .then(() => resolve()) // Resolver la promesa en caso de éxito
        .catch(error => reject(error)); // Rechazar la promesa en caso de error
    });

    connection.end(); // Cerrar la conexión
  });
}
//await updateDeletedStatus(123); // Llamada a la función para actualizar el estado de eliminación con el file_id deseado


async function updateDeletedStatus(file_id) {
    return new Promise((resolve, reject) => {
      const connection = mysql.createConnection({
        host: process.env.DB_HOST,
        user: process.env.DB_USER,
        password: process.env.DB_PASWORD,
        database: process.env.DB_DATABASE_NAME
      });

      const updateQuery = 'UPDATE assistant_gpt_files_ids SET deleted = ? WHERE id = ?';
      const deletedValue = true;

      connection.query(updateQuery, [deletedValue, file_id], (error, results) => {
        if (error) {
          reject(error); // Rechazar la promesa en caso de error
          return;
        }

        console.log(`Estado de eliminación actualizado a true para el archivo con id ${file_id}`);
        resolve(); // Resolver la promesa en caso de éxito
      });

      connection.end(); // Cerrar la conexión
    });
  }


// ELIMINAR DE OPENAI
async function delete_fileID(fileId) {
  const file = await openai.files.del(fileId);
  console.log("File Eliminado: ", file);
}
