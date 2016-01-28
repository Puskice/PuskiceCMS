@section('content')
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



                    <h2>Grafikon i rezultati</h2>
                    <ul class="nav nav-tabs">
                      <li class="active"><a data-toggle="tab" href="#bars-holder">Grafikon</a></li>
                      <li><a data-toggle="tab" href="#rezultat-holder">Rezultati</a></li>
                    </ul>
                    <div class="tab-content">
                      <div class="col-md-12 tab-pane fade in active" id="bars-holder">

                      </div>
                      <div class="col-md-12 no-padding tab-pane fade" id="rezultat-holder">
                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <th>Datum</th>
                              <th>Informacioni<br/>sistemi i tehn.</th>
                              <th>Menadžment</th>
                              <th>Operacioni<br/>menadžment</th>
                              <th>Upravljanje<br/>kvalitetom</th>
                              <th>Prva godina</th>
                              <th>Druga godina</th>
                              <th>Treća godina</th>
                              <th>Četvrta godina</th>
                              <th>Ukupno</th>
                            </tr>
                          </thead>
                          <tbody id="sum-res-body">

                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="col-md-12 no-padding" id="horizontal-axis-dates">

                    </div>



                    <div class="col-md-12 no-padding" style="margin-top: 10px; overflow:auto;">
                      <div class="col-md-6 no-padding">
                        <h2 style="text-indent:20px;">Kategorije:</h2>
                        <div class="col-md-6">
                          <ul class="list-group">
                            <li class="list-group-item filters-stat-date" id="godprva"><span class="glyphicon glyphicon-chevron-right bullet-active" style="display:none;"></span>Prva godina:<span class="badge">54</span></li>
                            <li class="list-group-item filters-stat-date" id="goddruga"><span class="glyphicon glyphicon-chevron-right bullet-active" style="display:none;"></span>Druga godina:<span class="badge">54</span></li>
                            <li class="list-group-item filters-stat-date" id="godtreca"><span class="glyphicon glyphicon-chevron-right bullet-active" style="display:none;"></span>Treća godina:<span class="badge">54</span></li>
                            <li class="list-group-item filters-stat-date" id="godcetvrta"><span class="glyphicon glyphicon-chevron-right bullet-active" style="display:none;"></span>Četvrta godina:<span class="badge">54</span></li>
                            <li class="list-group-item filters-stat-date" id="godukupno"><span class="glyphicon glyphicon-chevron-right bullet-active" style="display:none;"></span>Ukupno:<span class="badge">54</span></li>

                          </ul>
                        </div>
                        <div class="col-md-6">
                          <ul class="list-group">
                            <li class="list-group-item filters-stat-date" id="godisit"><span class="glyphicon glyphicon-chevron-right bullet-active" style="display:none;"></span>ISIT:<span class="badge">54</span></li>
                            <li class="list-group-item filters-stat-date" id="godmen"><span class="glyphicon glyphicon-chevron-right bullet-active" style="display:none;"></span>Menadžment:<span class="badge">54</span></li>
                            <li class="list-group-item filters-stat-date" id="godom"><span class="glyphicon glyphicon-chevron-right bullet-active" style="display:none;"></span>Operacioni menadžment:<span class="badge">54</span></li>
                            <li class="list-group-item filters-stat-date" id="goduk"><span class="glyphicon glyphicon-chevron-right bullet-active" style="display:none;"></span>Upravljanje kvalitetom:<span class="badge">54</span></li>
                          </ul>
                        </div>
                      </div>
                      <div class="col-md-6 no-padding">
                        <h2 style="text-indent:20px;">Metapodaci:</h2>
                        <div class="col-md-12 no-padding" id="hover-data">


                        </div>
                      </div>

                    </div>






                    <div class="col-md-12">
                      <table class="table table-hover" id="entryTable">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th class="col-md-2">Datum</th>
                            <th class="col-md-1">Smer</th>
                            <th class="col-md-1">Godina</th>
                            <th class="col-md-6">Predmeti</th>

                            <th class="col-md-3"></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($data as $key => $entry)
                          <tr>
                            <th scope="row">{{$key}}</th>
                            <td class="col-md-2">{{date('d.m.Y, H:i:s',strtotime($entry->created_at))}}</td>
                            <td class="col-md-1">{{$smerovi[$entry->department]}}</td>
                            <td class="col-md-1">{{($entry->semester+1)/2}}</td>
                            <td class="col-md-6">
                              @foreach ($entry->surveyevals as $subj)

                              @if($subj->entered==true)
                              <span class="label label-success">{{$subj->title}}</span>
                              @else
                              <span class="label label-default">{{$subj->title}}</span>

                              @endif



                              @endforeach
                            </td>
                            <td class="col-md-3"></td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>

                    </div>
                  </div>
                  <!-- /.box-body -->
                </div><!-- /.box -->        
              </div>
            </div>
            <script src="{{Request::root()}}/assets/frontend/js/stat.js"></script>  
            <script src="{{Request::root()}}/assets/frontend/js/jquery.tablesorter.min.js"></script>  
            <script type="text/javascript">
            $(document).ready(function(){
              $('[data-toggle="popover"]').popover({
                html : true, 
              });


              $("#entryTable").tablesorter({ 
               headers: { 
                 1: { 
                   sorter: false 
                 }, 
               } 
             }); 

              $.ajax({
                 // url: '../bydate/1', 
                url: "{{_l(URL::action('Ps_surveys@getEntriesByDate').'/1')}}",
                type: 'GET',
                success: function(msg){
                  setData(jQuery.parseJSON(msg));
                  populateGraphic();
                  populateTableInfo();
                }
              });
            });
            </script>

            @stop