import express from 'express';

const app = express();
const port = 3000;

app.use(express.json());

import * as dotenv from 'dotenv';
import { OpenAI } from "openai";

dotenv.config();

const openai = new OpenAI({
    apiKey: process.env.OPENAI_API_KEY,
});

app.get("/create_thread", (req, res) => {

    createThread().then((thread) => {
        res.json(thread);
    });
});

app.post('/create_run', (req, res) => {
    
    console.log("Datos del request: ", req.body.user_name);
    let data = {
        user_message: req.body.user_message,
        user_name: req.body.user_name,
        thread_id: req.body.thread_id,
        assistant_id: req.body.assistant_id,
    }
//console.log(data);
    createRun(data).then((thread) => {
        res.json(thread);
    });
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
        assistant_id: assistant.id
    }

    return data;
};

const createRun = async (data) => {
    console.log(data);
    const message = await openai.beta.threads.messages.create(data.thread_id, {
        role: "user",
        content: data.user_message,
    });
    //Run assistant 
    const run = await openai.beta.threads.runs.create(data.thread_id, {
        assistant_id: data.assistant_id,
        instructions: "Responde al usuario se llama " + data.user_name,
    });
     const run_retrieve = await openai.beta.threads.runs.retrieve(
        data.thread_id, //este dato es el thread_id del hilo creado
        run.id //este es el run_id al correr el run 
    )
    console.log("Datos del run: ", run);

    //obterner la respuesta de gpt

    const messages = await openai.beta.threads.messages.list(
        data.thread_id // ide el thread
    );

        let respuesta = [];

    messages.body.data.forEach((row) => {
        respuesta.push(row.content)
    });
    return respuesta;
};





















app.listen(port, () => {
    console.log(`El servidor está escuchando en el puerto ${port}`);
});