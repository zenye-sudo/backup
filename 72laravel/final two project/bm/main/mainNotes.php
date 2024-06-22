<?
//Mr-auto==Next element ko right kep say the
//MainNotes=>If you want to insert data of array to database=>You must advertise in thet sign yar model mar "protected $fillable=['title','name','content'];
//If you want to post form table by laravel,Laravel will request security token.It is csrf_field();
//If you want to vailade form datas by laravel,You must make request by "php artisan make:request insertDatas"=>and you will replace "authenticate='true'" and   in the public function rules(),'formname'=>'required'.Eg->'description'=>'required' and You will use in the productsController.php=   
Eg=>     public function returnn(insertDatas $request){
                $files=$request->file('file');
                foreach($files as $file){
                   echo $file->getClientOriginalName();
                }
                $title=$request->get('title');
                return redirect('/products/create');
         }and you will execute errors by $errors varible 
Eg=>     @foreach($errors->all() as $error)
         <div class="alert alert-warning">{{$error}}</div>
         @endforeach
******************For ZenChat Project start**********************
In web.php=>Route::get('/products/create','ProductController@create');
            Route::post('/products/create','ProductController@store');
In ProductController=>use App\Product;
                      use Storage;
                      public function store(insertProdctRequest $request)
                      {
                       $file=$request->file('file');
                       $fileName=$file->getClientOriginalName();
                       $newName=uniqid()."_".$fileName;
                       $file->move(public_path()."/uploads/",$newName);
                       //For store in storage section start
                       // Storage::put('uploads/'.$fileName,file_get_contents($file));
                       //For store in storage section End
                       Product::create([
                           'title'=>$request->get('title'),
                           'description'=>$request->get('description'),
                           'prices'=>$request->get('price'),
                           'writer'=>$request->get('writer'),
                           'imgs'=>$newName
                       ]);
                       return redirect('products/create')->with('status','Successfully Insert');
                       }
In ProductController(multi-insert)=>use App\Product;
                                   use Storage;
                                  public function store(insertProdctRequest $request){
                                     $files=$request->file('file');
                                     $filesAry=[];
                                     foreach($files as $file){
                                         $newName=uniqid()."_".$file->getClientOriginalName();
                                         $file->move(public_path()."/uploads/",$newName);
                                         array_push($filesAry,$newName);

                                         }
                                            Product::create([
                                          'title'=>$request->get('title'),
                                           'description'=>$request->get('description'),
                                           'prices'=>$request->get('price'),
                                           'writer'=>$request->get('writer'),
                                           'imgs'=>serialize($filesAry)
                                       ]);
                                      return redirect('products/create')->with('status','Successfully Insert');
                                   }
                       Note=>If you want to vailade data , YOu must create request. "php artisan make:request InsertDatasRequest";

***********************For ZenChat Project End**********************
***********************Laravel Session start**************************
-Note=>If you use session,You must use "Request $request" in oop method.
In web.php=>Route::get('/','SessionController@index');
            Route::get('/putSession','SessionController@putSession');
            Route::get('/allSession','SessionController@allSession');
            Route::get('/getSession','SessionController@getSession');
            Route::get('/deleteSession','SessionController@deleteSession');
            Route::get('/multipleSet',"SessionController@multipleSet");
In home.php=><body>
              @if(session('status'))
                  {{session('status')}}<br>
                  @endif
              <a href="{{url('/putSession')}}"><button>Set Single Session</button></a>
              <a href="{{url('/allSession')}}"><button>All Session</button></a>
              <a href="{{url('/getSession')}}"><button>Get Session</button></a>
              <a href="{{url('/deleteSession')}}"><button>Delete session</button></a>
              <a href="{{url('/multipleSet')}}"><button>MultipleSet</button></a>
             </body>
In SessionController=>namespace App\Http\Controllers;
                      use Illuminate\Http\Request;
                      class SessionController extends Controller
                      {
                          public function index(){
                              return view('home');
                          }
                          public function putSession(Request $request){
                              $request->session()->put('name','zenye');
                              return redirect('/')->with('status','Successfully set single session');
                          }
                          public function allSession(Request $request){
                              $all=$request->session()->all();
                              return $all;
                          }
                          public function getSession(Request $request){
                               $name=$request->session()->get('name');
                               return redirect('/')->with('status',$name);
                           }
                           public function deleteSession(Request $request){
                           $request->session()->flush();
                               return redirect('/')->with('status','Deleted Successful');
                           }
                           public function multipleSet(Request $request){
                           $request->session()->put(['age'=>18,'work'=>'programmer']);
                           return redirect('/')->with('status',"Multiple Inserted successful!");
                           }
                       }

In cartsystem=>public function add(Request $request,$id){
                $items=array();
                if($request->session()->has('items')){
                     $items=$request->session()->get('items');
                     if(!in_array($id,$items)){
                         array_push($items,$id);
                     }
                }else{
                    array_push($items,$id);
                }
        
                $request->session()->put('items',$items);
//                $request->session()->flush();
                $products=Product::all();
                return view('home',compact('products'));
            }

***********************Laravel Session End**************************



                    