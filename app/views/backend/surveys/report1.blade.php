@section('content')
<?php 
function preparePopover($key,$questions){

  $ans = $questions[$key]['question'];
  if (is_array($questions[$key]['answers']))
  {
    foreach ($questions[$key]['answers'] as $keyw => $answ)
    {
      if($answ != ''){
        $ans = $ans."<br/>".$keyw.". ".$answ;
      }
    }
  }
  return $ans;
}


$global_data = array(
  'total'=>0,
  1=>array(1=>0,2=>0,3=>0,4=>0,5=>0),
  2=>array(1=>0,2=>0,3=>0,4=>0,5=>0),
  3=>array(1=>0,2=>0,3=>0,4=>0,5=>0),
  4=>array(1=>0,2=>0,3=>0,4=>0,5=>0),
  5=>array(1=>0,2=>0,3=>0,4=>0,5=>0),
  6=>array(1=>0,2=>0),
  7=>array(1=>0,2=>0,3=>0,4=>0),
  8=>array(1=>0,2=>0,3=>0,4=>0,5=>0),
  9=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0),
  10=>array(1=>0,2=>0,3=>0,4=>0,5=>0)
  );

  ?>

<link rel="stylesheet" href="{{Request::root()}}/assets/frontend/css/stat.css">

<div class="row">
  <div class="col-md-12">
    <div class="box">
             <!--  <div class="box-header">
             <h3 class="box-title"></h3>
                     <div class="box-tools">
                        <div class="input-group">
                            <input type="text" name="table_search" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                  </div> --> <!-- /.box-header -->
                  <div class="box-body no-padding">
                    <div class="col-md-12" id="statistic-filter">
                      <div class="col-md-6">
                        <table class="table">
                          <thead>
                            <tr>
                              <th class="col-md-1">Godina</th>
                              <th class="text-center col-md-1">ISIT</th>
                              <th class="text-center col-md-1">Menadžment</th>
                              <th class="text-center col-md-1">Operacioni menadžment</th>
                              <th class="text-center col-md-1">Upravljanje kvalitetom</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th scope="row" class="col-md-1 year-tbl">1 godina</th>
                              <td class="col-md-1"><input class="form-control filter-checkbox input-sm center-box" type="checkbox" value="dep0sem1" checked></td>
                              <td class="col-md-1"><input class="form-control filter-checkbox input-sm center-box" type="checkbox" value="dep0sem1" checked></td>
                            </tr>
                            <tr>
                             <th scope="row" class="col-md-1 year-tbl">2 godina</th>
                             <td class="col-md-1"><input class="form-control filter-checkbox input-sm center-box" type="checkbox" value="dep1sem3" checked></td>
                             <td class="col-md-1"><input class="form-control filter-checkbox input-sm center-box" type="checkbox" value="dep2sem3" checked></td>
                             <td class="col-md-1"><input class="form-control filter-checkbox input-sm center-box" type="checkbox" value="dep3sem3" checked></td>
                             <td class="col-md-1"><input class="form-control filter-checkbox input-sm center-box" type="checkbox" value="dep4sem3" checked></td>
                           </tr>
                           <tr>
                            <th scope="row" class="col-md-1 year-tbl">3 godina</th>
                            <td class="col-md-1"><input class="form-control filter-checkbox input-sm center-box" type="checkbox" value="dep1sem5" checked></td>
                            <td class="col-md-1"><input class="form-control filter-checkbox input-sm center-box" type="checkbox" value="dep2sem5" checked></td>
                            <td class="col-md-1"><input class="form-control filter-checkbox input-sm center-box" type="checkbox" value="dep3sem5" checked></td>
                            <td class="col-md-1"><input class="form-control filter-checkbox input-sm center-box" type="checkbox" value="dep4sem5" checked></td>
                          </tr>
                          <tr>
                            <th scope="row" class="col-md-1 year-tbl">4 godina</th>
                            <td class="col-md-1"><input class="form-control filter-checkbox input-sm center-box" type="checkbox" value="dep1sem7" checked></td>
                            <td class="col-md-1"><input class="form-control filter-checkbox input-sm center-box" type="checkbox" value="dep2sem7" checked></td>
                            <td class="col-md-1"><input class="form-control filter-checkbox input-sm center-box" type="checkbox" value="dep3sem7" checked></td>
                            <td class="col-md-1"><input class="form-control filter-checkbox input-sm center-box" type="checkbox" value="dep4sem7" checked></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="col-md-6" style="position:relative;">
                      <div class="col-md-12 bottom-buttons">
                        <button class="btn btn-lg btn-primary" id="filtriraj-btn">Filtriraj</button>
                        <button class="btn btn-lg btn-warning" id="ukloni-sum-btn">Ukloni sumarne</button>
                      </div>
                    </div>
                  </div>
                  <br clear="all">

                  <div class="col-md-12">




                    <div class="panel-group" id="accordion-stat" role="tablist" aria-multiselectable="true">

                      <?php 
                      $index = 0;

                      foreach ($data as $key => $subject):
                    //for color classes
                        $index += 1;

                      if(is_int($key)){
                       $classNum = $index%10;
                     } else {
                      $classNum = 'total';
                    }
                    //data
                    $entry_num = array_sum($subject[1]);


                    ?>




                    <div class="panel panel-default panel-result {{implode(" ",$subject['classes'])}}">
                      <div class="panel-heading stat-color-{{$classNum}}" role="tab" id="headingOne">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" class="stat-subj-name collapsed" href="#{{'collapse'.$key}}" aria-expanded="false" aria-controls="{{'collapse'.$key}}">
                           {{$subject['name']}} <span class="pull-right">Broj unosa:&nbsp;{{$entry_num}}</span>
                         </a>
                       </h4>
                     </div>
                     <div id="{{'collapse'.$key}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                       <div class="panel-body"> 
                         <table class="table table-bordered stat-subj-table">
                          <thead>

                            <tr>
                              <th class="text-center col-md-1">Pitanje:</th>
                              <th class="text-center col-md-1">0</th>
                              <th class="text-center col-md-1">1</th>
                              <th class="text-center col-md-1">2</th>
                              <th class="text-center col-md-1">3</th>
                              <th class="text-center col-md-1">4</th>
                              <th class="text-center col-md-1">5</th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php foreach ($subject as $key => $answer): 

                            if (is_int($key)): ?>

                            <tr>
                              <th class="text-center col-md-1 stat-question-num">
                                <button type="button" class="btn btn-xs btn-info pull-right" data-container="body" data-toggle="popover" data-placement="left" data-content="{{ preparePopover($key,$survey_questions);}}">
                                  ?
                                </button>
                                <br clear="all">
                                {{$key}}
                              </th>
                              @for ($i = 0; $i <= 5; $i++)

                              @if (!array_key_exists($i, $answer))
                              <td class="text-center col-md-1"></td> 

                              @else
                              <td class="text-center col-md-1"><span class="stat-percentage">{{round(100*$answer[$i]/$entry_num,1)."%"}}</span><br/>{{$answer[$i].'/'.$entry_num}}</td> 
                              @endif

                              @endfor 

                              <td class="text-center col-md-6 stat-graphic">
                                <div class="col-md-1">
                                  @for ($i = 0; $i <= 5; $i++)

                                  @if (!array_key_exists($i, $answer))

                                  @else
                                  <div class="stat-bar-data">{{$i}}</div>

                                  @endif

                                  @endfor 
                                </div>
                                <div class="col-md-11">
                                 @for ($i = 0; $i <= 5; $i++)

                                 @if (!array_key_exists($i, $answer))

                                 @else
                                 <div class="stat-bar" style="width:{{round(100*$answer[$i]/$entry_num,1)}}%;"><span class="pull-left"></span></div>

                                 @endif

                                 @endfor 
                               </div>

                             </td>
                           </tr>
                         <?php endif ?>

                       <?php endforeach ?>
                     </tbody>
                   </table>
                 </div> 
               </div>
             </div>
           <?php endforeach ?>

           <!-- Ukupni -->
         </div>
       </div>
     </div><!-- /.box-body -->
   </div><!-- /.box -->        
 </div>
</div>

<script src="{{Request::root()}}/assets/frontend/js/results.js"></script>  
<script type="text/javascript">
$(document).ready(function(){
  $('[data-toggle="popover"]').popover({
    html : true, 
  });
});

</script>
@stop