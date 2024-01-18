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
    const deletedValue = 0;

    connection.query(selectQuery, [deletedValue], (error, results) => {
      if (error) {
        reject(error); // Rechazar la promesa en caso de error
        return;
      }

      console.log('Filas encontradas:');
      console.log(results);
      const promises = results.map(item => getFileData(item.id));
      Promise.all(promises)
        .then(() => resolve()) // Resolver la promesa en caso de éxito
        .catch(error => reject(error)); // Rechazar la promesa en caso de error
    });

    connection.end(); // Cerrar la conexión
  });
}

// ELIMINAR DE OPENAI
async function getFileData(fileId) {
  const file = await openai.files.del(fileId);
  console.log("File Eliminado: ", file);
}
