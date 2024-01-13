import express from "express";

const app = express();
const port = 3000;

import path from 'path';

app.use(express.json());

import * as dotenv from "dotenv";
import { OpenAI } from "openai";
import fs from 'fs';


dotenv.config();

const openai = new OpenAI({
    apiKey: process.env.OPENAI_API_KEY,
});



// ------------------- Metodos GET o POST DEL API ----------------------------------------------------------

app.get("/create_thread", (req, res) => {
    createThread().then((thread) => {
        res.json(thread);
    });
});

app.post("/create_run_", (req, res) => {
    console.log("Datos del request: ", req.body.user_name);
    let data = {
        user_message: req.body.user_message,
        user_name: req.body.user_name,
        thread_id: req.body.thread_id,
        assistant_id: req.body.assistant_id,
    };

    //console.log(data);
    createRun(data).then((thread) => {
        res.json(thread);
    });
});

app.post("/get_run_pending", (req, res) => {
    console.log("Datos del run pendiente: ", req.body.thread_id);
    let data = {
        thread_id: req.body.thread_id,
        run_id: req.body.run_id,
    };
    //console.log(data);
    getPendingRun(data).then((thread) => {
        res.json(thread);
    });
});
            //------------metodos para usar archivos

            app.post("/create_run", (req, res) => {
                console.log("Datos del request con file: ", req.body.user_name);
                console.log("------->>>>>>>_>>_>_>_>_>_>_>_>_>_>_>_>_>__> \n -------->>>>>>", req.body.file);

                // Verifica si se ha enviado un archivo
                if (req.body.file) {
                    console.log("llegó un archivo");
                    const directorioActual = "\\var\\www\\html\\lysite-test\\asistente_lyon\\";  //CAMBIAR RUTA TEST POR LA REAL
                    const rutaDeseada = path.join(directorioActual, '..', 'storage', 'app', 'asistente_lyon');
                    console.log(req.body.file);

                    const file = "/var/www/html/lysite-test/asistente_lyon/asistente_lyon/"+req.body.file;
                    // // Obtiene la extensión del archivo
                    // const fileExtension = file.name.split('.').pop();

                    // // Obtiene el nombre del archivo
                    // const fileName = randomName(file.name.split('.').shift());

                    // const filePath = '/temp_files/asisstant/'+ fileName + '.' + fileExtension;
                    const filePath = file;
                  //  Mueve el archivo al directorio especificado


                        let data = {
                            user_message: req.body.user_message,
                            user_name: req.body.user_name,
                            thread_id: req.body.thread_id,
                            assistant_id: req.body.assistant_id,
                            file_path: filePath
                        };

                        createRun(data).then((thread) => {
                            res.json(thread);
                        });

                } else {
                    console.log("no llegó ningún archivo");
                    // No se envió ningún archivo
                    let data = {
                        user_message: req.body.user_message,
                        user_name: req.body.user_name,
                        thread_id: req.body.thread_id,
                        assistant_id: req.body.assistant_id,
                        file_path: null
                    };

                    createRun(data).then((thread) => {
                        res.json(thread);
                    });
                }
            });





const createThread = async () => {
    //usar uno existente usando su Id
    const assistant = await openai.beta.assistants.retrieve(
        process.env.ASSISTANT_LYON
    );

    //creando Threads o HILOS de conversación
    const thread = await openai.beta.threads.create();
    console.log("35 Datos del Thread: ", thread);

    let data = {
        thread_id: thread.id,
        assistant_id: assistant.id,
    };

    return data;
};

const createRun = async (data) => {
    const archivo = data.file_path;
    console.log(data);

    if(archivo != null){
            // Upload a file with an "assistants" purpose
                const file = await openai.files.create({
                    file: fs.createReadStream(archivo),
                    purpose: "assistants",
                });

                const message = await openai.beta.threads.messages.create(data.thread_id, {
                role: "user",
                content: data.user_message,
                file_ids: [file.id]
                });
    }else{
                const message = await openai.beta.threads.messages.create(data.thread_id, {
                role: "user",
                content: data.user_message,
                });
    }

    //Run assistant
    const run = await openai.beta.threads.runs.create(data.thread_id, {
        assistant_id: data.assistant_id,
        instructions:
            "Responde al usuario solo según las instrucciones del asistente, limitate a ayudar y/o asistir a todo lo relacionado a investiación cientifica, tesis, articulos cientificos y similares; el usuario se llama " +
            data.user_name,
    });

    await new Promise((resolve) => setTimeout(resolve, 500));
    const run_retrieve = await openai.beta.threads.runs.retrieve(
        data.thread_id, //este dato es el thread_id del hilo creado
        run.id //este es el run_id al correr el run
    );
    console.log("Datos del run: ", run);
    console.log("STATUS DEL RUN -> ", run_retrieve["status"]);
    let check_run = run_retrieve["status"];
    let steps = 0;
    while (check_run != "completed") {
        await new Promise((resolve) => setTimeout(resolve, 500));
        const check_run_retrieve = await openai.beta.threads.runs.retrieve(
            data.thread_id, //este dato es el thread_id del hilo creado
            run.id //este es el run_id al correr el run
        );
        console.log("STATUS DEL RUN -> ", check_run_retrieve["status"]);
        check_run = check_run_retrieve["status"];
        steps++;
        if(steps > 11){
            var resp = {};
            resp['run_id'] = check_run_retrieve['id'];
            resp['thread_id'] = check_run_retrieve['thread_id'];
            resp['status'] = "Pending";
            return resp;
            break;
        }
    }

    //obterner la respuesta de gpt

    let respuesta = [];

    const messages = await openai.beta.threads.messages.list(
        data.thread_id // ide el thread
    );

    messages.body.data.forEach((row) => {
        respuesta.push(row.content);
    });
    return respuesta;
};

const getPendingRun = async (data) => {
    let check_run = null;
    let steps = 0;
    while (check_run != "completed") {
        await new Promise((resolve) => setTimeout(resolve, 500));
        const get_run_retrieve = await openai.beta.threads.runs.retrieve(
            data.thread_id, //este dato es el thread_id del hilo creado
            data.run_id //este es el run_id al correr el run
        );
        console.log("STATUS DEL RUN -> ", get_run_retrieve["status"]);
        check_run = get_run_retrieve["status"];
        steps++;
        if(steps > 11){
            var resp = {};
            resp['run_id'] = get_run_retrieve['id'];
            resp['thread_id'] = get_run_retrieve['thread_id'];
            resp['status'] = "Pending";
            return resp;
            break;
        }
    }

    let respuesta = [];

    const messages = await openai.beta.threads.messages.list(
        data.thread_id // ide el thread
    );

    messages.body.data.forEach((row) => {
        respuesta.push(row.content);
    });
    return respuesta;
};

function randomName(name) {
    let result = '';
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

    // Establece la semilla utilizando una cadena específica
    Math.seedrandom(name);

    for (let i = 0; i < 8; i++) {
      const randomIndex = Math.floor(Math.random() * characters.length);
      result += characters.charAt(randomIndex);
    }

    return result;
  }

app.listen(port, () => {
    console.log(`El servidor está escuchando en el puerto ${port}`);
});
