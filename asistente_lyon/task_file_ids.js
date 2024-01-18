import express from "express";

const app = express();

import mysql from 'mysql2';

import path from 'path';

app.use(express.json());

import * as dotenv from "dotenv";
import { OpenAI } from "openai";
import fs from 'fs';


dotenv.config();

const openai = new OpenAI({
    apiKey: process.env.OPENAI_API_KEY,
});
var file_id;
var filename;







  // Llamada a la función pasando "file-abc123" como argumento
  //getFileData("file-abc123");



function file_ids_deleting() {
    const connection = mysql.createConnection({
        host: process.env.DB_HOST,
        user: process.env.DB_USER,
        password: process.env.DB_PASWORD,
        database: process.env.DB_DATABASE_NAME
      });

      const selectQuery = 'SELECT * FROM assistant_gpt_files_ids WHERE deleted = ? AND created_at <= DATE_SUB(NOW(), INTERVAL 2 HOUR)';
      const deletedValue = false;

      connection.query(selectQuery, [deletedValue], (error, results) => {
        if (error) {
          console.error('Error al realizar la consulta: ' + error.stack);
          return;
        }

        console.log('Filas encontradas:');
        console.log(results);
      });
  }

  async function getFileData(fileId) {
    const file = await openai.files.del(fileId);
    console.log("File Eliminado: ", file);
  }
