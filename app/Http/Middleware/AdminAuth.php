<?php



namespace App\Http\Middleware;



use Closure;

Use Auth;

Use Redirect;



class AdminAuth

{

    /**

     * Handle an incoming request.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \Closure  $next

     * @return mixed

     */

    public function handle($request, Closure $next)
    { 
        $url = 'http://localhost/project-login/public/check-login';
        $header = array(
            'Content-Type: application/json'
        );

        $curl_arr = curl_init($url);
        curl_setopt($curl_arr, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_arr, CURLOPT_MAXREDIRS, 10);
        // curl_setopt($curl_arr, CURLOPT_POST, true);
        curl_setopt($curl_arr, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl_arr, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl_arr, CURLOPT_BINARYTRANSFER, true);
      
        curl_setopt($curl_arr, CURLOPT_HTTPHEADER, $header);
        $buffer = curl_exec($curl_arr);
        curl_close($curl_arr);

        $response = json_decode($buffer);

        if($response->status=='error' && $response->login_key==null)
        {
            return redirect('http://localhost/project-login/public/login?page_segment=http://localhost/project-two/public/admin/dashboard'); 
        }
      return $next($request);

    }

}

