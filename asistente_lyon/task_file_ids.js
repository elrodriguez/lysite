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


file_ids_deleting();


console.log('Conexión cerrada');
console.log('Archivos Eliminados de OPENAI exitosamente...');
process.exit(0); // Salir del proceso con éxito







// FUNCION PARA BUSQUEDA DE ARCHIVOS NO ELIMINADOS DE OPENAI
function file_ids_deleting() {
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
          console.error('Error al realizar la consulta: ' + error.stack);
          return;
        }

        console.log('Filas encontradas:');
        console.log(results);
        results.forEach(item => {
            getFileData(item.id);
        });
      });
  }

  // ELIMINAR DE OPENAI
  async function getFileData(fileId) {
    const file = await openai.files.del(fileId);
    console.log("File Eliminado: ", file);
  }
