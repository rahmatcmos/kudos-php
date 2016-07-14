<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use Redirect ;
use Session ;

class AdminController extends \App\Http\Controllers\Controller
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;
    
    /*
     * language list
     */
    public $languages = [
      'ab'=>'Abkhazian',
      'aa'=>'Afar',
      'af'=>'Afrikaans',
      'sq'=>'Albanian',
      'am'=>'Amharic',
      'ar'=>'Arabic',
      'an'=>'Aragonese',
      'hy'=>'Armenian',
      'as'=>'Assamese',
      'ay'=>'Aymara',
      'az'=>'Azerbaijani',
      'ba'=>'Bashkir',
      'eu'=>'Basque',
      'bn'=>'Bengali',
      'dz'=>'Bhutani',
      'bh'=>'Bihari',
      'bi'=>'Bislama',
      'br'=>'Breton',
      'bg'=>'Bulgarian',
      'my'=>'Burmese',
      'be'=>'Belarusian',
      'km'=>'Cambodian',
      'ca'=>'Catalan',
      'zh'=>'Chinese',
      'co'=>'Corsican',
      'hr'=>'Croatian',
      'cs'=>'Czech',
      'da'=>'Danish',
      'nl'=>'Dutch',
      'en'=>'English',
      'eo'=>'Esperanto',
      'et'=>'Estonian',
      'fo'=>'Faeroese',
      'fa'=>'Farsi',
      'fj'=>'Fiji',
      'fi'=>'Finnish',
      'fr'=>'French',
      'fy'=>'Frisian',
      'gl'=>'Galician',
      'gd'=>'Gaelic (Scottish)',
      'gv'=>'Gaelic (Manx)',
      'ka'=>'Georgian',
      'de'=>'German',
      'el'=>'Greek',
      'kl'=>'Greenlandic',
      'gn'=>'Guarani',
      'gu'=>'Gujarati',
      'ht'=>'Haitian Creole',
      'ha'=>'Hausa',
      'he'=>'Hebrew',
      'hi'=>'Hindi',
      'hu'=>'Hungarian',
      'is'=>'Icelandic',
      'io'=>'Ido',
      'in'=>'Indonesian',
      'ia'=>'Interlingua',
      'ie'=>'Interlingue',
      'iu'=>'Inuktitut',
      'ik'=>'Inupiak',
      'ga'=>'Irish',
      'it'=>'Italian',
      'ja'=>'Japanese',
      'jv'=>'Javanese',
      'kn'=>'Kannada',
      'ks'=>'Kashmiri',
      'kk'=>'Kazakh',
      'rw'=>'Kinyarwanda',
      'ky'=>'Kirghiz',
      'rn'=>'Kirundi',
      'ko'=>'Korean',
      'ku'=>'Kurdish',
      'lo'=>'Laothian',
      'la'=>'Latin',
      'lv'=>'Latvian',
      'li'=>'Limburgish',
      'ln'=>'Lingala',
      'lt'=>'Lithuanian',
      'mk'=>'Macedonian',
      'mg'=>'Malagasy',
      'ms'=>'Malay',
      'ml'=>'Malayalam',
      'mt'=>'Maltese',
      'mi'=>'Maori',
      'mr'=>'Marathi',
      'mo'=>'Moldavian',
      'mn'=>'Mongolian',
      'na'=>'Nauru',
      'ne'=>'Nepali',
      'no'=>'Norwegian',
      'oc'=>'Occitan',
      'or'=>'Oriya',
      'ps'=>'Pashto',
      'pl'=>'Polish',
      'pt'=>'Portuguese',
      'pa'=>'Punjabi',
      'qu'=>'Quechua',
      'rm'=>'Rhaeto-Romance',
      'ro'=>'Romanian',
      'ru'=>'Russian',
      'sm'=>'Samoan',
      'sg'=>'Sangro',
      'sa'=>'Sanskrit',
      'sr'=>'Serbian',
      'sh'=>'Serbo-Croatian',
      'st'=>'Sesotho',
      'tn'=>'Setswana',
      'sn'=>'Shona',
      'ii'=>'Sichuan Yi',
      'sd'=>'Sindhi',
      'si'=>'Sinhalese',
      'ss'=>'Siswati',
      'sk'=>'Slovak',
      'sl'=>'Slovenian',
      'so'=>'Somali',
      'es'=>'Spanish',
      'su'=>'Sundanese',
      'sw'=>'Swahili',
      'sv'=>'Swedish',
      'tl'=>'Tagalog',
      'tg'=>'Tajik',
      'ta'=>'Tamil',
      'tt'=>'Tatar',
      'te'=>'Telugu',
      'th'=>'Thai',
      'bo'=>'Tibetan',
      'ti'=>'Tigrinya',
      'to'=>'Tonga',
      'ts'=>'Tsonga',
      'tr'=>'Turkish',
      'tk'=>'Turkmen',
      'tw'=>'Twi',
      'ug'=>'Uighur',
      'uk'=>'Ukrainian',
      'ur'=>'Urdu',
      'uz'=>'Uzbek',
      'vi'=>'Vietnamese',
      'vo'=>'Volapük',
      'wa'=>'Wallon',
      'cy'=>'Welsh',
      'wo'=>'Wolof',
      'xh'=>'Xhosa',
      'yi'=>'Yiddish',
      'yo'=>'Yoruba',
      'zu'=>'Zulu'] ;
    
    public function __construct()
    {
      // get all shops
      $shops = Shop::all() ;
    
      // if there are no shops force user to add one
      if(count($shops) == 0){
        Session::flash('warning',  trans('shops.required'));
        return Redirect::to('shops/create');
      }
      
      // if session is not set or the shop doesn't exist reset the session for the shop
      if ( !Session::has('shop') || Shop::where('_id', '=', Session::get('shop'))->count()==0 ){
        $shop = Shop::first() ;
        Session::put('shop', $shop->id) ;
      }
      
      // if session is not set reset the session for the language
      if ( !Session::has('language')){
        Session::put('language', config('app.locale')) ;
      }
      
      view()->share('select_shops', $shops);
      view()->share('languages', $this->languages);
      view()->share('language', Session::get('language')) ;
    }
    
    public function login()
    {  
      if ( Auth::check() && Auth::user()->isAdmin() )
        return Redirect::to('admin/dashboard') ;
      return view('auth/admin-login');
    }
}
