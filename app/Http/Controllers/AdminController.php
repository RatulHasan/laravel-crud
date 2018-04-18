<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        date_default_timezone_set('asia/dhaka');

    }

    public function dashboard()
    {

        return view('admin.pages.main_content');
    }

    public function crud()
    {

        return view('admin.all_contents.crud');
    }

    public function get_table_name(Request $request){
//
        $table_name  =  $request->input('table_name');

        $get_db_info  =  \DB::getDatabaseName();


        $get_table_info  =  \Schema::getColumnListing($table_name);

        $count = count($get_table_info);

        if($count!= 0) {
            echo 1;
        }else{
            echo 0;
        }

//        dd($get_table_info);
    }


    public function saveCrud(Request $request)
    {
        $table_name  =  $request->input('table_name',true);

        $get_db_info  =  \DB::getDatabaseName();

        $get_table_info  =  \Schema::getColumnListing($table_name);
        $get_table_column_info  =  DB::select("describe $table_name");

//        dd($get_table_column_info);



        try {

                /**
                 * MAKE ROUTES
                 */

                $makeRoutes = "

/**
 * MAKE ROUTES FOR ".ucwords($table_name)."
 */
Route::get('/" . $table_name . "','" . ucfirst($table_name) . "Controller@index');
Route::post('/save_" . $table_name . "','" . ucfirst($table_name) . "Controller@save" . ucfirst($table_name) . "');
Route::patch('/update_" . $table_name . "','" . ucfirst($table_name) . "Controller@update" . ucfirst($table_name) . "');
/**
 * MAKE ROUTES FOR ".ucwords($table_name)."
 */";


            $file = "routes/web.php";
            $fh = fopen($file,'a') or die("Unable to open file!");
// using file_put_contents() instead of fwrite()
                fwrite($fh, $makeRoutes);

                fclose($fh);

                /**
                 * MAKE ROUTES
                 */


                $masterExtends = 'admin.master';
                $sectionContent = 'main_content';
                $data = '$data';
                $dataObj = '$data->';


            /**
             * MAKE LIST VIEW
             */

            $table_head='';
            $td='';
            $editData='';
            $requiredSpan = '';
            $required = '';
            $allData = '$allData';

            $formInput = '';
            $formUpdateInput = '';
            $ajaxData = '';
            $getPriKey = '';
            $i = 0;

            foreach($get_table_info as $key => $get_table){
//                print_r($get_table);
//                echo "\n";
                if($get_table == "updated_at"){
//                    date("d-m-Y", strtotime($data->created_on))
//                        $td .= '
//                        <td>{{ date("d-m-Y", strtotime(' . $dataObj . $get_table . ')) }}</td>
//                    ';
                }else {
                    if($get_table == "created_on"){
//                    date("d-m-Y", strtotime($data->created_on))
                        $td .= '
                        <td>{{ date("d-m-Y", strtotime(' . $dataObj . $get_table . ')) }}</td>
                    ';
                    }else {
                        $td .= '
                        <td>{{ ' . $dataObj . $get_table . ' }}</td>
                    ';
                    }
                }
                    $editData .= "data-$get_table=\"{{ $dataObj$get_table }}\"
                    ";


                $column=ucfirst($get_table);
                $column=str_replace("_"," ","$column");
                if($get_table == "updated_at") {

                }else {
                    $table_head .= "
                                <th>" . $column . "</th>
                            ";
                }

                if($get_table_column_info[$i]->Null == 'NO'){
                    $requiredSpan = "<span class=\"required\">*</span>";
                    $required = "required";
                }else{
                    $requiredSpan = '';
                    $required = '';
                }

                if($get_table_column_info[$i]->Key != 'PRI'){
                    if($get_table == "created_on" || $get_table == "updated_at") {

                    }else{
                        if($get_table == "start_from" || $get_table == "end_to") {
                            $formInput .= "
                        <div class=\"form-group\" id=\"pre_vou_code1\">
                            <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"$get_table\">
                                " . ucwords($column) . " " . $requiredSpan . "
                            </label>

                            <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                <input $required type=\"date\" name=\"$get_table\" autocomplete=\"off\" id=\"$get_table\" class=\"form-control col-md-7 col-xs-12\">
                            </div>
                        </div>";
                            $formUpdateInput .= "            
                        <div class=\"form-group\" id=\"pre_vou_code1\">
                            <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"edit_$get_table\">
                                " . ucwords($column) . " " . $requiredSpan . "
                            </label>

                            <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                <input $required type=\"date\" name=\"$get_table\" autocomplete=\"off\" id=\"edit_$get_table\" class=\"form-control col-md-7 col-xs-12\">
                                
                            </div>
                        </div>";
                        }else {
                            if ($get_table == "status") {
                                    $formInput .= "
                            <div class=\"form-group\" id=\"pre_vou_code1\">
                                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"$get_table\">
                                    " . ucwords($column) . " " . $requiredSpan . "
                                </label>
    
                                <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                    <select required name=\"$get_table\" id=\"$get_table\" class=\"form-control col-md-7 col-xs-12\">
                                        <option value=\"Active\">Active</option>
                                        <option value=\"Inactive\">Inactive</option>
                                    </select>
                                </div>
                            </div>";
                                    $formUpdateInput .= "            
                            <div class=\"form-group\" id=\"pre_vou_code1\">
                                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"edit_$get_table\">
                                    " . ucwords($column) . " " . $requiredSpan . "
                                </label>
    
                                <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                    <select required name=\"$get_table\" id=\"edit_$get_table\" class=\"form-control col-md-7 col-xs-12\">
                                        <option value=\"Active\">Active</option>
                                        <option value=\"Inactive\">Inactive</option>
                                    </select>
                                    
                                </div>
                            </div>";
                            } else {
                                $formInput .= "
                        <div class=\"form-group\" id=\"pre_vou_code1\">
                            <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"$get_table\">
                                " . ucwords($column) . " " . $requiredSpan . "
                            </label>

                            <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                <input $required type=\"text\" name=\"$get_table\" autocomplete=\"off\" id=\"$get_table\" class=\"form-control col-md-7 col-xs-12\">
                            </div>
                        </div>";
                                $formUpdateInput .= "            
                        <div class=\"form-group\" id=\"pre_vou_code1\">
                            <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"edit_$get_table\">
                                " . ucwords($column) . " " . $requiredSpan . "
                            </label>

                            <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                <input $required type=\"text\" name=\"$get_table\" autocomplete=\"off\" id=\"edit_$get_table\" class=\"form-control col-md-7 col-xs-12\">
                                
                            </div>
                        </div>";
                            }
                        }


                        $ajaxData .= "
        var $get_table = $(this).data('" . $get_table . "');
        $(\"#edit_" . $get_table . "\").val($get_table);";
                    }
                }else{

                    $getPriKey = $get_table;

$formUpdateInput .=
    "<input type=\"hidden\" name=\"$get_table\" id=\"edit_$get_table\" class=\"form-control col-md-7 col-xs-12\">";
                    $ajaxData .= "
        var $get_table = $(this).data('".$get_table."');
        $(\"#edit_".$get_table."\").val($get_table);";
                }

                $i++;
            }

//            dd($getPriKey);



                $createViewContent = "@extends('" . $masterExtends . "')
@section('".$sectionContent."')
<link rel=\"stylesheet\" href=\"{{ asset('public/admin-panel/css/datatables.net-bs/css/dataTables.bootstrap.min.css') }}\">
<div class=\"box box-info\">
    <div class=\"box-header\">
        <a data-target=\"#" . $table_name . "\" data-toggle=\"modal\" class=\"btn btn-flat btn-primary pull-right btn-sm\">Add new</a>
    </div>
    <!-- /.box-header -->
    <div class=\"box-body table-responsive\">

        <table id=\"example1\" class=\"table table-bordered table-striped\">
            <thead>
            <tr>                
                ".$table_head."
                
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($allData as $data)
                <tr>
                    ".$td."
                    <td>
                        <button type=\"button\" class=\"btn btn-primary btn-xs button edit_button\"
                                data-toggle=\"modal\" data-target=\"#edit_" . $table_name . "\"
                                $editData>
                            <i class=\"fa fa-pencil\" ></i > Edit
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->

<div aria-hidden=\"true\" aria-labelledby=\"myModalLabel\" role=\"dialog\" tabindex=\"-1\" id=\"" . $table_name . "\" class=\"modal fade\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            <div class=\"modal-header\">
                <button aria-hidden=\"true\" data-dismiss=\"modal\" class=\"close\" type=\"button\">×</button>
                <h3 class=\"modal-title\">".ucwords($table_name)." form </h3>
            </div>
            <div class=\"modal-body\">
                <div class=\"row\">
                    <form method=\"post\" action=\"{{ URL::to('save_" . $table_name . "') }}\" data-parsley-validate class=\"form-horizontal form-label-left\">
                        {{ csrf_field() }}
                        ".$formInput."
                        <div class=\"ln_solid\"></div>
                        <div class=\"form-group\">
                            <div class=\"col-md-6 col-sm-6 col-xs-12 col-md-offset-3\">
                                <button type=\"submit\" id=\"button\" class=\"btn btn-primary btn-flat pull-right\">Save</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>


{{--For edit--}}
<div aria-hidden=\"true\" aria-labelledby=\"myModalLabel\" role=\"dialog\" tabindex=\"-1\" id=\"edit_" . $table_name . "\" class=\"modal fade\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            <div class=\"modal-header\">
                <button aria-hidden=\"true\" data-dismiss=\"modal\" class=\"close\" type=\"button\">×</button>
                <h3 class=\"modal-title\">Edit ".ucwords($table_name)." form </h3>
            </div>
            <div class=\"modal-body\">
                <div class=\"row\">
                    <form method=\"post\" action=\"{{ URL::to('update_" . $table_name . "') }}\" data-parsley-validate class=\"form-horizontal form-label-left\">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        ".$formUpdateInput."
                        <div class=\"ln_solid\"></div>
                        <div class=\"form-group\">
                            <div class=\"col-md-6 col-sm-6 col-xs-12 col-md-offset-3\">
                                <button type=\"submit\" id=\"button\" class=\"btn btn-primary btn-flat pull-right\">Update</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    $(document).on( \"click\", '.edit_button',function(e) {
        ".$ajaxData."

    });
</script>
<!-- DataTables -->
<script src=\"{{ asset('public/admin-panel/css/datatables.net/js/jquery.dataTables.min.js') }}\"></script>
<script src=\"{{ asset('public/admin-panel/css/datatables.net-bs/js/dataTables.bootstrap.min.js') }}\"></script>
<script>
    $(function () {
        $('#example1').DataTable({
            'pageLength': 25,
            'order': [ 0, 'desc' ]
        })
    })
</script>
@endsection";





            /*
             * FOR CONTROLLER
            */

            $controller_name = ucfirst($table_name) . "Controller.php";
            $controller_path = 'app/Http/Controllers/';

            $created = '$allData["created_on"] = date("Y-m-d H:i:s");';
            $updated = '$allData["updated_at"] = date("Y-m-d H:i:s");';
            $req = '$request';
            $_token = "['_token']";
            $_method = "['_method']";


            $createControllerContent = "<?php
    /**
     * This Controller is auto generated by CRUD System. ".date('d-m-Y H:i:sa')."
     *
     * @Author Ratul Hasan
     * @Git url # https://github.com/RatulHasan/
     */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

session_start();

class " . ucfirst($table_name) . "Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {

        date_default_timezone_set('asia/dhaka');

    }

    public function index()
    {
        $allData = DB::table('" . $table_name . "')->get();

        return view('admin." . $table_name . ".$table_name', get_defined_vars());

    }

    public function save".ucfirst($table_name)." (Request $req)
    {
        $allData = request()->all();
        unset($allData$_token);
        $created
        DB::table('$table_name')->insert($allData);
        
        return Redirect::back();

    }

    public function update".ucfirst($table_name)." (Request $req)
    {
        $allData = request()->all();
        unset($allData$_token);
        unset($allData$_method);
        $updated
        DB::table('$table_name')->where('$getPriKey',".$allData."['$getPriKey'])->update($allData);
        
        return Redirect::back();

    }

}    ";


            $view_page_name = $table_name . ".blade.php";
            $view_page_path = 'resources/views/admin/';

            if (!file_exists($view_page_path . "/" . $table_name)) {

                mkdir($view_page_path . "/" . $table_name , 0777, true);

                file_put_contents($view_page_path . "/" . $table_name . "/" . $view_page_name, $createViewContent);

                chmod($view_page_path . "/" . $table_name , 0777); // MAKE VIEW FOLDER 777

                chmod($view_page_path . "/" . $table_name . "/" . $view_page_name, 0777); // MAKE VIEW PAGE 777


            }

                file_put_contents($controller_path . $controller_name, $createControllerContent);

                chmod($controller_path . $controller_name, 0777);


                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.content', '<strong>Well done!</strong> Task successfully done.
            <script>
                $(".alert1-success").delay(350).addClass("in").fadeOut(4000);
            </script>');


            return Redirect::back();

        }
        catch (\Exception $e) {

            return $e->getMessage();

        }
    }


    public function member()
    {
        $all_members  =  DB::table('my_profile')->orderby('member_name', 'ASC')->get();

        return view('admin.all_contents.member', get_defined_vars());
    }
}
