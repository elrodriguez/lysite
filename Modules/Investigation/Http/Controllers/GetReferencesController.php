<?php

namespace Modules\Investigation\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class GetReferencesController extends Controller
{
    protected $client;
    public $code_consulta;
    public $is_doi;

    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client();
    }

    public function index()
    {
        return view('citar');
    }

    public function citar(Request $request)
    {
        $doi = $request->get('input-doi');
        $is_doi = true;
        if (strpos($doi, '/')) {
            $doi = str_replace("https://dx.doi.org/", "", $doi); // ES DOI
            $doi = str_replace("https://doi.org/", "", $doi); // ES DOI
            $doi = str_replace("http://dx.doi.org/", "", $doi); // ES DOI
            $doi = str_replace("http://doi.org/", "", $doi); // ES DOI
        } else {
            $doi = str_replace("-", "", $doi);
            $is_doi = false;         //es ISBN
        }
        $this->code_consulta=$doi;
        $this->is_doi=true;

        $normativa = $request->get('select-normativa');

        

        $response = $this->client->request('POST', 'https://api.mendeley.com/oauth/token', [
            'form_params' => [
                'grant_type' => 'client_credentials',
                'client_id' => env('MENDELEY_CLIENT_ID'),
                'client_secret' => env('MENDELEY_CLIENT_SECRET'),
                'scope' => 'all'
            ]
        ]);

        $body = $response->getBody();

        $accessToken = json_decode($body)->access_token;

        /////////////luego buscamos el documento para optener el id/////////////////

        $headers = [
            'Authorization' => 'Bearer ' . $accessToken,
            'Accept' => 'application/vnd.mendeley-document.1+json'
        ];

        if ($is_doi) {
           $search_url = "https://api.mendeley.com/catalog?doi=" . urlencode($doi);

    
                                        //             // Make a request to the link
                                        // $response = Http::get('https://www.mendeley.com/catalogue/1152eea5-ed0e-3f81-88bf-be4f34aecabf/');

                                        // // Get the body of the response
                                        // $body = $response->body();

                                        // // Convert the body to a string
                                        // $html = (string)$body;
                                        // $partes = explode('data-name="citation"', $html);
                                        // $len=count($partes);
                                        // $partes=$partes[$len-1];
                                        // //</div>
                                        // $partes = explode('</div>', $partes);

                                        // $parte_despues = strstr($partes[0], '>');
                                        // if ($parte_despues !== false) {
                                        //     $parte_despues = substr($parte_despues, 1);
                                        // }
                                        // dd("<p>".$parte_despues);

        } else {
            $search_url = "https://api.mendeley.com/catalog?isbn=" . $doi;
        }

        $response = $this->client->request('GET', $search_url, [
            'headers' => $headers
        ]);

        $document = json_decode($response->getBody()->getContents());

        $cita = $this->generar_cita($document, $normativa);

        return response()->json(['cita' => $cita]);
    }

    public function generar_cita($document, $normativa)
    {
        if(count($document)>0){
            switch ($normativa) {
                case 'apa':
                    return $this->generate_apa($document[0]); 
                case 'iso690':
                    return $this->generate_iso690($document[0]);               
                case 'vancouver':
                    return $this->generate_vancouver($document[0]);
                default:
                    return 'Formato de cita no válido';
            }
        }else{
            return "Lo sentimos, No hemos podido encontrar el codigo que has brindado";
        }       
    
    }

    public function generate_apa($document)
    {
        
                                        // Consultando la WEB de mendeley según el ID
                                        $response = Http::get('https://www.mendeley.com/catalogue/'.$document->id.'/');

                                        // Get the body of the response
                                        $body = $response->body();

                                        // Convert the body to a string
                                        $html = (string)$body;
                                        $partes = explode('data-name="citation"', $html);
                                        $len=count($partes);
                                        $partes=$partes[$len-1];
                                        //</div>
                                        $partes = explode('</div>', $partes);

                                        $parte_despues = strstr($partes[0], '>');
                                        if ($parte_despues !== false) {
                                            $parte_despues = substr($parte_despues, 1);
                                        }
                                        $citation ="<p>".$parte_despues;                                        

                                        $citation = str_replace('Elsevier B.V.', '', $citation);
                                        $posicion = strrpos($citation, "). "); // Busca la última ocurrencia de "). " en el string
                                        $citation = substr_replace($citation, ". ", $posicion, strlen("). ")); // Reemplaza la ocurrencia encontrada por ". "
                                        $citation = str_replace(' (Vol. ', ', ', $citation);                                       
                                        $citation = str_replace('. In ', '. ', $citation);
                                        $citation = str_replace('pp.', '', $citation);

        // $authors = array();

        // //Obtener el nombre de los autores
        // foreach ($document->authors as $author) { //solo la inicial del primer nombre
        //     if ($document->type == "book") {
        //         array_push($authors, str_replace(" ", "-", $author->last_name) . ", " . substr($author->first_name, 0, 1) . ".");
        //     } else {
        //         array_push($authors, $author->last_name . ", " . substr($author->first_name, 0, 1) . ".");
        //     }
        // }

        // $citation = '<p>';
        // //Añadir los apellidos de los autores
        // if (count($authors) == 1) {
        //     $citation .= $authors[0] . " ";
        // } elseif (count($authors) == 2) {
        //     $citation .= $authors[0] . " y " . $authors[1] . " ";
        // } elseif (count($authors) == 3) {
        //     $citation .= $authors[0] . ", " . $authors[1] . ", y " . $authors[2] . " ";
        // } elseif (count($authors) == 4) {
        //     $citation .= $authors[0] . ", " . $authors[1] . ", " . $authors[2] . ", y " . $authors[3] . " ";
        // } elseif (count($authors) == 5) {
        //     $citation .= $authors[0] . ", " . $authors[1] . ", " . $authors[2] . ", " . $authors[3] . ", y " . $authors[4] . " ";
        // } elseif (count($authors) == 5) {
        //     $citation .= $authors[0] . ", " . $authors[1] . ", " . $authors[2] . ", " . $authors[3] . ", " . $authors[4] . ", y " . $authors[5] . " ";
        // } elseif (count($authors) > 5) {
        //     $citation .= $authors[0] . ", " . $authors[1] . ", " . $authors[2] . ", " . $authors[3] . ", " . $authors[4] . ", " . $authors[5] . ", y " . $authors[6] . " ";
        // }

        // //Añadir el año de publicación y el título del artículo
        // $citation .= "(" . substr($document->year, 0, 4) . "). " . $document->title . ". ";

        // //Añadir el nombre de la revista
        // if (isset($document->source)) {
        //     $citation .= "<i>" . $document->source . "</i>";
        // }

        // //Añadir el volumen y el número (si están disponibles)
        // if (isset($document->volume)) {
        //     $citation .= ", " . $document->volume;
        // }
        // if (isset($document->issue)) {
        //     $citation .= "(" . $document->issue . ")";
        // }

        // //Añadir las páginas
        // if (isset($document->pages)) {
        //     $citation .= ", " . $document->pages;
        // }

        // //Añadir el DOI
        // if (isset($document->identifiers->doi)) {
        //     $citation .= ' <a href="https://doi.org/' . $document->identifiers->doi . '">' . "https://doi.org/" . $document->identifiers->doi . '</a>';
        // }

        // $citation .= "</p>";

        return $citation;
    }

            
    public function generate_iso690($document)
    {
        $authors = array();

        //Obtener el nombre de los autores
        foreach ($document->authors as $author) {
            $last_name = explode(" ", $author->last_name);
            $last_name = mb_strtoupper($last_name[0], 'UTF-8');
            $name = $last_name . ', ' . $author->first_name;
            array_push($authors, $name);
        }

        $citation = '<p>';

        //Añadir los nombres de los autores
        if (count($authors) == 1) {
            $citation .= $authors[0] . '. ';
        } elseif (count($authors) == 2) {
            $citation .= $authors[0] . ' a ' . $authors[1] . '. ';
        } else {
            for ($i = 0; $i < count($authors) - 1; $i++) {
                $citation .= $authors[$i] . ', ';
            }
            $citation .= 'a ' . $authors[count($authors) - 1] . '. ';
        }

        //Añadir el título del artículo
        $citation .= $document->title . '. ';

        //Añadir el nombre de la revista
        if (isset($document->source)) {
            $citation .= '<em>' . $document->source . '</em> '. ' [en línea] ';
        }

        $volumen_and_pages = $this->getVolumen_and_pages($document);
        //Añadir el año de publicación
        $citation .= $document->year . ', ' . $volumen_and_pages;

        //Añadir las páginas
        if (isset($document->pages)) {
            $citation .= 's. ' . $document->pages . '. ';
        }

        //Fecha de consulta
        $month = date('n');
        switch ($month) {
            case '1':
                $month = "enero";
                break;
            case '2':
                $month = "febrero";
                break;
            case '3':
                $month = "marzo";
                break;
            case '4':
                $month = "abril";
                break;
            case '5':
                $month = "mayo";
                break;
            case '6':
                $month = "junio";
                break;
            case '7':
                $month = "julio";
                break;
            case '8':
                $month = "agosto";
                break;
            case '9':
                $month = "septiembre";
                break;
            case '10':
                $month = "octubre";
                break;
            case '11':
                $month = "noviembre";
                break;
            case '12':
                $month = "diciembre";
                break;
        }
        setlocale(LC_TIME, 'es_ES.UTF-8');
        $fecha_actual = Carbon::now()->formatLocalized('%e de ' . $month . ' de %Y');
        $string_fecha = " [Fecha de consulta: " . $fecha_actual . "] ";
        $citation .= $string_fecha;


        //Añadir el DOI
        //dd($document->identifiers->doi);
        if (isset($document->identifiers->doi)) {
            $citation .= 'Disponible en: <a href="https://doi.org/' . $document->identifiers->doi . '">' . "https://doi.org/" . $document->identifiers->doi . '</a>.';
        }

        if(isset($document->identifiers->issn)) {
            $citation .= ' ISSN: ' . $document->identifiers->issn;
        }

        $citation .= '</p>';

        return $citation;
    }

    
    public function generate_vancouver($document)
    {
        $authors = array();

        //Obtener el nombre de los autores
        foreach ($document->authors as $author) {
            $first_lastname = explode(" ", $author->last_name); //en vancouver solo el primer apellido
            array_push($authors, $first_lastname[0] . " " . substr($author->first_name, 0, 1) . "."); // inicial de nombre
        }

        $citation = '<p>';

        //Añadir los apellidos y las iniciales de los nombres de los autores
        foreach ($authors as $key => $author) {
            $name_parts = explode(" ", $author);
            $initials = "";

            foreach ($name_parts as $part) {
                $initials .= substr($part, 0, 1) . ".";
            }

            if ($key === count($authors) - 1) {
                $citation .= $author . " ";
            } else {
                $citation .= $author . ", ";
            }
        }

        //Añadir el título del artículo
        if ($document->type == "book") {
            $citation .= $document->title . " [Internet]. ";
        } else {
            $citation .= $document->title . ". ";
        }

        //Añadir el nombre de la revista
        if (isset($document->source) && $document->title != $document->source) {
            $citation .= "<em>" . $document->source . "</em>. ";
        }

        //Añadir el año de publicación
        $citation .= $document->year . ";";

        //Añadir el volumen
        if (isset($document->volume)) {
            $citation .= $document->volume . ":";
        }

        //Añadir las páginas
        if (isset($document->pages)) {
            $citation .= $document->pages . ".";
        }
        if($this->is_doi){
            $citation .= ' https://dx.doi.org/'.$this->code_consulta.'.</p>';
        }else{
            $citation .= '</p>';
        }

        // $apa_citation = $this->generate_apa($document); //se usa porque este tiene información de paginas y volumen
        // $explotado = explode("https://doi", $apa_citation);
        // $explotado = explode('<i>'.$source.'</i>,', $explotado[0]);
        // $volumen_and_pages="";
        // if( count($explotado) > 1 ){
        //     $volumen_and_pages = $explotado[1];
        // }
        $volumen_and_pages = $this->getVolumen_and_pages($document);
        $citation = str_replace('https://dx.doi.org/', $volumen_and_pages.'https://dx.doi.org/', $citation);
        $citation = str_replace('https://dx.doi.org/'.$this->code_consulta, '<a href="'.'https://dx.doi.org/'.$this->code_consulta.'" target="_blank">'.'https://dx.doi.org/'.$this->code_consulta.'</a>', $citation);
        return $citation;
    }

    public function getVolumen_and_pages($document){
        $year = $document->year;
        $source = $document->source;
        $apa_citation = $this->generate_apa($document); //se usa porque este tiene información de paginas y volumen
        $explotado = explode("https://doi", $apa_citation);
        $explotado = explode('<i>'.$source.'</i>,', $explotado[0]);
        $volumen_and_pages="";
        if( count($explotado) > 1 ){
            $volumen_and_pages = $explotado[1];
        }
        return $volumen_and_pages;
    }
}