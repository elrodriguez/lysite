<?php

namespace Modules\Investigation\Http\Controllers;

use App\Models\Person;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use OpenAI\Laravel\Facades\OpenAI;

class GetArticlesRecommendationController extends Controller
{
    public function getArticles(Request $request)
    {
        $consulta = $request->get('re-input-text');
        $resultado = "espera un momento...";

        if (strlen($consulta) > 6) {
            $permisos = Person::where('user_id', Auth::user()->id)->first();
            $p_allowed = $permisos->paraphrase_allowed;
            $p_used = $permisos->paraphrase_used;

            if ($p_allowed > $p_used) {

                $max_tokens = 3400;
                $temperature = 0.7;

                $result_text = "hubo un problema, intenta mas tarde";

                $consulta = "Dame un listado de títulos de artículos científicos reales sobre: {" . $consulta . "} presenta esta lista en idioma inglés, luego presenta la misma lista traducida al español y finalmente presenta la misma lista traducida al portugués. por favor recuerda presentar las listas dentro de etiquetas HTML";

                try {
                    $result = OpenAI::completions()->create([
                        'model' => 'gpt-4',
                        'prompt' => $consulta,
                        'max_tokens' => $max_tokens,
                        'temperature' => $temperature,
                    ]);
                    $result_text = $result['choices'][0]['text'];
                    $query_tokens = $result['usage']['prompt_tokens'];
                    $result_tokens = $result['usage']['completion_tokens'];
                    $consumed_tokens = $result['usage']['total_tokens'];
                    $permisos->paraphrase_used = $p_used + 1;
                    $permisos->save();
                } catch (Exception $e) {
                    $result_text = $e->getMessage();
                }
                $resultado = $result_text;
            } else {
                $resultado = "Lo siento, pero parece que has superado tu límite de consultas. Para continuar utilizando este servicio, por favor comunícate con los administradores para solicitar un aumento en tu límite. Estamos aquí para ayudarte y queremos asegurarnos de que tengas la mejor experiencia posible. ¡Gracias por usar nuestro servicio!";
            }
        } else {
            $resultado = Auth::user()->name . " aprovecha este servicio escribiendo párrafos mas extensos que el que acabas de escribir, esta consulta no será tomada en cuenta";
        }
        return response()->json(['result' => $resultado]);
    }
}
