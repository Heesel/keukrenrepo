<?php

use Illuminate\Support\Facades\Route;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use Illuminate\Support\Facades\Input;
use App\User;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PagesController@index');
route::resource('posts', 'PostsController');
Route::get('/overzicht', 'PagesController@overview');
Route::get('/posts/{id}/example', 'PostsController@example');
Auth::routes();
Auth::routes(['verify' => true]);
Route::get('/home', 'PagesController@index')->name('home');
route::resource('admin/posts', 'HomeController');
route::resource('admin/users', 'userController');
route::get('admin/aanvragen', 'KeukenfabrikantController@adminview');
Route::get('/keukens', 'PagesController@keukens')->name('keukens');
Route::get('/nieuws', 'PagesController@niews')->name('nieuws');
route::resource('admin/posts', 'HomeController');
route::resource('admin/users', 'userController');
Route::post('comments/{post_id}', ['as' => 'comments.stored', 'uses' => 'CommentsController@store']);
route::resource('comments', 'CommentsController');
route::resource('admin/FAQ', 'FAQAdminController');
route::get('/faq', 'FAQController@index');
route::get('/links', 'LinksController@index');
Route::resource('admin/links', 'LinksAdminController');
route::resource('profile', 'profileController');
Route::group(['middleware' => ['auth']], function(){
Route::post('favorite/{post}/add', 'FavoriteController@add')->name('post.favorite');
route::resource('Aposts', 'PostsAdminController');
});

Route::match(['GET', 'POST'], '/contact', function() {
    if(request()->isMethod('post')) {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.office365.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'keukenfab@outlook.com';                     // SMTP username
            $mail->Password   = 'V~p+BS$$ED6=2iT';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;          
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        
            //Recipients
            $mail->setFrom('keukenfabrikant@outlook.com');
            $mail->addAddress('hesselpa@live.nl', 'Hessel Palland');     // Add a recipient
            $mail->addReplyTo($_POST['email']);
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');
        
            // Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'contact';
            $mail->Body    = '<h4 align="left">Naam:'.'&nbsp;'.$_POST['first'].'&nbsp'.$_POST['last'].'<br>Email: '.$_POST['email'].'<br>Telnr: '.$_POST['phone'].'<br><br>bericht: '.$_POST['message'];
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            return view('mail.success');
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    return view('mail.contact');
});

Route::get('/keukenfabrikant', 'KeukenfabrikantController@index');
Route::post('/aanvragen', 'KeukenfabrikantController@store');

// Search functie
Route::get('/search', 'userController@search');
Route::post('/keukenfabrikant/afwijzen/{id}', 'KeukenfabrikantController@destroy');
Route::post('/keukenfabrikant/goedkeuren/{id}', 'KeukenfabrikantController@accept');
