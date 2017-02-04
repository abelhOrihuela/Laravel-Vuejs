<!DOCTYPE html>
<html lang="es">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  <title></title>

  <link rel="stylesheet" href="css/keytalent.css">
  <link rel="stylesheet" href="../css/keytalent.css">
  <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">


</head>
<body>
  <div class="">
    <img alt="" width="160" src="img/keytalentwtc.png">  </div>

    <div class="container-detail">
      <div class="container-detail-header">
        <strong>P e r f i l</strong>
      </div>
      <div class="panel-body">

        <div class="header-pdf">
          <div class="header-pdf-img">
            <div>
              <img src="{{ $candidate->photo->name_photo }}" alt="" />
            </div>
          </div>

          <div class="header-pdf-text">

            <div class="">
              <strong>{{ $candidate->username }}</strong>
            </div>

            <div class="">
              <div class="text-description-fields">
                <div class="text-label">
                  <label class="label-a">Corre Electronico</label>
                </div>
                <div class="text-description">
                  {{ $candidate->email }}
                </div>
              </div>
            </div>

            <div class="">
              <div class="text-description-fields">
                <div class="text-label">
                  <label class="label-a">Genero</label>
                </div>
                <div class="text-description">
                  {{ $candidate->gender }}
                </div>
              </div>
            </div>

            <div class="">
              <div class="text-description-fields">
                <div class="text-label">
                  <label class="label-a">Lugar de Residencia</label>
                </div>
                <div class="text-description">
                  {{ $candidate->location }}
                </div>
              </div>
            </div>

            <div class="">
              <div class="text-description-fields">
                <div class="text-label">
                  <label class="label-a">Fecha de Nacimiento</label>
                </div>
                <div class="text-description">
                  {{ $candidate->day }}/
                  {{ $candidate->month }}/
                  {{ $candidate->year }}
                </div>
              </div>
            </div>

            <div class="">
              <div class="text-description-fields">
                <div class="text-label">
                  <label class="label-a">Telefono</label>
                </div>
                <div class="text-description">
                  {{ $candidate->code }} /
                  {{ $candidate->phone }}
                </div>
              </div>
            </div>
            <div class="">
              <div class="text-description-fields">
                <div class="text-label">
                  <label class="label-a">Categoria</label>
                </div>
                <div class="text-description">
                  {{ $candidate->categoryCandidate->name }}
                </div>
              </div>
            </div>

            <div class="">
              <div class="text-description-fields">
                <div class="text-label">
                  <label class="label-a">SubCategoria</label>
                </div>
                <div class="text-description">
                  {{ $candidate->subcategoryCandidate->name }}
                </div>
              </div>
            </div>
          </div>
        </div>
        <br>
        <div class="container-table-pdf">
          <div class="">
            <label class="label-a">
            <strong>Formacion Academica</strong>
          </label>
          </div>
          <table class="pure-table font-table-wtc border-table">
            <thead>
              <tr>
                <th>Institucion</th>
                <th>Carrera / Profesion</th>
                <th>Nivel Academico</th>
                <th>Periodo</th>
                <th>Comentarios</th>
                <th>Actual</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($candidate->academics as $academic)
                <tr>
                  <td>
                    {{ $academic->name_academic }}
                  </td>
                  <td>
                    {{ $academic->career }}
                  </td>
                  <td>
                    {{ $academic->level_academic }}
                  </td>
                  <td>
                    {{ $academic->year_entry }}/ {{ $academic->year_exit }}
                  </td>
                  <td>
                    {{ $academic->comments }}
                  </td>
                  <td>
                    @if ($academic->now === 1)
                      Si
                    @else
                      No
                    @endif
                  </td>
                </tr>

              @endforeach
            </tbody>
          </table>
        </div>
        <br>

        <div class="container-table-pdf">
          <div class="">
            <label class="label-a">
              <strong>Experiencia</strong>
            </label>
          </div>
          <table class="pure-table font-table-wtc border-table">
            <thead>
              <tr>
                <th class="bg-blue">Empresa</th>
                <th>Puesto</th>
                <th>Giro</th>
                <th>Periodo</th>
                <th>Commentarios</th>
                <th>Actual</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($candidate->experiences as $experience)
                <tr>
                  <td>
                    {{ $experience->name_business }}
                  </td>
                  <td>
                    {{ $experience->name_job }}
                  </td>
                  <td>
                    {{ $experience->turn_business }}
                  </td>
                  <td>
                    {{ $experience->admission_date }}/
                    {{ $experience->departure_date }}
                  </td>
                  <td>
                    {{ $experience->comments }}
                  </td>
                  <td>
                    @if ($experience->now === 1)
                      Si
                    @else
                      No
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <br>

        <div class="container-table-pdf">
          <div class="">
            <label class="label-a">
              <strong>Expectativa Economica</strong>
            </label>
          </div>
          <table class="pure-table font-table-wtc border-table">
            <thead>
              <tr>
                <th>Salario Actual</th>
                <th>Paquete Economico</th>
                <th>Expectativa Economica</th>
                <th>Comentarios</th>
                <th>Reubicacion</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  {{  $candidate->economic->current_salary }}
                </td>
                <td>
                  {{  $candidate->economic->economic_package }}
                </td>
                <td>
                  {{  $candidate->economic->salary_expectation }}
                </td>
                <td>
                  {{  $candidate->economic->comments }}
                </td>
                <td>
                  @if ( $candidate->economic->relocation === 1)
                    Si
                  @else
                    No
                  @endif
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>
  </html>
