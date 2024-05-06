 <x-headadmin></x-headadmin>
 <!-- Contenedor del contenido de la pagina -->
<div class="page-content p-5" id="content">
<!-- Contenido de la pagina de admin menu (dashboard) -->
<h2>Dashboard <span class="text-gray float-end">SanTrips</span></h2>
<hr>
<div class="row my-5">
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card ">
                  <div class="card-body">
                    <img src="" class="card-img-absolute" alt="" />
                    <h4 class="font-weight-normal mb-3">Usuarios Registrados<i class="mdi mdi-chart-line mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">0</h2>
                    <h6 class="card-text"><a href="{{ Route('adminusuarios')}}" style="text-decoration: none; color: black;">Ir a Admin Usuarios</a></h6>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card  ">
                  <div class="card-body">
                    <img src="" class="card-img-absolute" alt="" />
                    <h4 class="font-weight-normal mb-3">Empleados Registrados<i class="mdi mdi-bookmark-outline mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">0</h2>
                    <h6 class="card-text"><a href="{{ Route('adminempleados')}}" style="text-decoration: none; color: black;">Ir a Admin Empleados</a></h6>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card">
                  <div class="card-body">
                    <img src="" class="card-img-absolute" alt="" />
                    <h4 class="font-weight-normal mb-3">Vehiculos Registrados<i class="mdi mdi-diamond mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">0</h2>
                    <h6 class="card-text"><a href="{{ Route('adminvehiculos')}}" style="text-decoration: none; color: black;">Ir a Admin Vehiculos</a></h6>
                  </div>
                </div>
              </div>
            </div>

          
            <div class="row">
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card ">
                  <div class="card-body">
                    <img src="" class="card-img-absolute" alt="" />
                    <h4 class="font-weight-normal mb-3">Paquetes Turísticos Registrados<i class="mdi mdi-chart-line mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">0</h2>
                    <h6 class="card-text"><a href="{{ Route('adminpaquetes')}}" style="text-decoration: none; color: black;">Ir a Admin Paquetes</a></h6>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card  ">
                  <div class="card-body">
                    <img src="" class="card-img-absolute" alt="" />
                    <h4 class="font-weight-normal mb-3">Destinos Registrados<i class="mdi mdi-bookmark-outline mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">0</h2>
                    <h6 class="card-text"><a href="{{ Route('admindestinos')}}" style="text-decoration: none; color: black;">Ir a Admin Destinos</a></h6>
                  </div>
                </div>
              </div>
            
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card">
                  <div class="card-body">
                    <img src="" class="card-img-absolute" alt="" />
                    <h4 class="font-weight-normal mb-3">Empresas Proveedoras Registradas<i class="mdi mdi-diamond mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">0</h2>
                    <h6 class="card-text"><a href="{{ Route('adminempresasproveedoras')}}" style="text-decoration: none; color: black;">Ir a Admin Empresas Proveedoras</a></h6>
                  </div>
                </div>
              </div>
            </div>

            <div class="row my-5">
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card ">
                  <div class="card-body">
                    <img src="" class="card-img-absolute" alt="" />
                    <h4 class="font-weight-normal mb-3">Reservaciones Realizadas<i class="mdi mdi-chart-line mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">0</h2>
                    <h6 class="card-text"><a href="{{ Route('adminreservas')}}" style="text-decoration: none; color: black;">Ir a Admin Reservas</a></h6>
                  </div>
                </div>
              </div> 
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card  ">
                  <div class="card-body">
                    <img src="" class="card-img-absolute" alt="" />
                    <h4 class="font-weight-normal mb-3">Pagos Pendientes<i class="mdi mdi-bookmark-outline mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">0</h2>
                    <h6 class="card-text"><a href="{{ Route('adminpagos')}}" style="text-decoration: none; color: black;">Ir a Admin Pagos</a></h6>
                  </div>
                </div>
              </div>
            
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card">
                  <div class="card-body">
                    <img src="" class="card-img-absolute" alt="" />
                    <h4 class="font-weight-normal mb-3">Ganancias<i class="mdi mdi-diamond mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">0</h2>
                    <h6 class="card-text"><a href="#" style="text-decoration: none; color: black;">Visualizar Ganancias</a></h6>
                  </div>
                </div>
              </div>
            </div>


<br>
<hr>
<!-- Aqui se mostrarán los graficos de ECharts -->
<div class="row container">

  <div class="col-sm-2 col-md-6">
               <!-- Prepare a DOM with a defined width and height for ECharts -->
      <div id="Gananciasxtiempo" style="width: 25em;height:25em;"></div>
      <script type="text/javascript">
        // Initialize the echarts instance based on the prepared dom
        var myChart = echarts.init(document.getElementById('Gananciasxtiempo'));
  
        // Specify the configuration items and data for the chart
        var option = {
          title: {
            text: 'Ganancias por periodo de tiempo (RD$)'
          },
          tooltip: {},
          
          xAxis: {
            data: ['Este año (RD$)', 'Ultimos 6 meses (RD$)', 'Ultimos 3 meses (RD$)', 'Este mes (RD$)', 'Esta semana (RD$)', 'Hoy (RD$)']
          },
          yAxis: {},
          series: [
            {
              name: 'Ventas',
              type: 'bar',
              data: [1000000, 500000, 250000, 100000, 25000, 5000]
            }
          ]
        };
  
        // Display the chart using the configuration items and data just specified.
        myChart.setOption(option);
      </script>
      </div>
   
      <div class="col-sm-2 col-md-6 ">
      <div id="Destinosmasvisitados" style="width: 25em;height:25em;"></div>
      <script type="text/javascript">
        // Initialize the echarts instance based on the prepared dom
        var myChart = echarts.init(document.getElementById('Destinosmasvisitados'));
  
        // Specify the configuration items and data for the chart
        var option = {
          title: {
            text: 'Destinos mas visitados'
          },        
    legend: {
      orient: 'vertical',
      x: 'right',
      data: ['Destino 1', 'Destino 2', 'Destino 3', 'Destino 4', 'Destino 5']
    },
    series: [
      {
        type: 'pie',
        radius: ['50%', '70%'],
        avoidLabelOverlap: false,
        label: {
          show: false,
          position: 'center'
        },
        labelLine: {
          show: false
        },
        emphasis: {
          label: {
            show: true,
            fontSize: '30',
            fontWeight: 'bold'
          }
        },
        data: [
          { value: 335, name: 'Destino 1' },
          { value: 310, name: 'Destino 2' },
          { value: 234, name: 'Destino 3' },
          { value: 135, name: 'Destino 4' },
          { value: 1548, name: 'Destino 5' }
        ]
      }
    ]
  };
        // Display the chart using the configuration items and data just specified.
        myChart.setOption(option);
      </script>
      </div>
 
  </div>
 <x-footeradmin></x-footeradmin>