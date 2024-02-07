<div class="table-container">
    <style>
        .table td[contenteditable="true"] {
            border: 1px solid #d3d0d0;
            min-width: 100px;
            /* Cambia el color y el grosor del borde según tus necesidades */
        }

        .table_border {
            border: 1px solid #d3d0d0;
        }

        .table-container {
            overflow-x: auto;
        }
    </style>

    <div>&nbsp;</div>
    <table class="table">
        <thead>
            <tr align="center">
                <th class="editable-cell">Role</th>
                <th>HR</th>
                <th>HA</th>
                <th>amount</th>
                @for ($i = 1; $i <= $project->number_months; $i++)
                    <th>M{{ $i }}</th>
                @endfor
            </tr>
        </thead>
        <tbody>
            @foreach ($project->team->sortBy('project_role') as $team)
                <tr align="center">
                    <td align="left"><strong>{{ $team->project_role->name }}</strong>
                    </td>
                    <td>{{ $team->hr }}</td>
                    <td>{{ $team->ha }}</td>
                    <td>{{ $team->number }}</td>
                    @foreach ($team->getData($project->id, $team->project_role_id) as $data)
                        <td contenteditable="true" id="c{{ $data->id }}" onkeypress="return isNumberKey(event)"
                            onblur="sendData({{ $data->id }},this.textContent,{{ $data->month }},{{ $team->number }})">
                            {{ $data->value }}</td>
                    @endforeach

                </tr>
            @endforeach

            <tr align="center">
                <td align="left" colspan="4"><strong>Monthly Hrs</strong></td>
                @for ($i = 1; $i <= $project->number_months; $i++)
                    <th class="table_border"><span id="total{{ $i }}">
                            {{ $project->getTotalHours($project->id, $i) }}</span></th>
                @endfor

            </tr>


            <tr align="center">
                <td align="left" colspan="4"><strong>Monthly Investment</strong></td>
                @for ($i = 1; $i <= $project->number_months; $i++)
                    <th class="table_border"><span id="investment{{ $i }}">
                            ${{ number_format($project->getMonthlyInvestment($project->id, $i), 2, '.', ',') }}
                        </span></th>
                @endfor

            </tr>

            <tr align="center">
                <td align="left" colspan="3"><strong>Estimated Investment</strong>
                </td>
                <td align="right"><strong> $<span
                            id="estimated_investment">{{ number_format($project->getEstimatedInvestment($project->id), 2, '.', ',') }}</span></strong>
                </td>
                @for ($i = 1; $i <= $project->number_months; $i++)
                    <td></td>
                @endfor

            </tr>

            <tr align="center">
                <td align="left" colspan="3"><strong>Ballpark up +</strong></td>
                <td align="right"><strong> $<span
                            id="ballpark_up">{{ number_format($project->getEstimatedInvestment($project->id) * 1.25, 2, '.', ',') }}</span></strong>
                </td>
                @for ($i = 1; $i <= $project->number_months; $i++)
                    <td></td>
                @endfor

            </tr>

            <tr align="center" id="totales">
                <td align="left" colspan="3"><strong>Ballpark down -</strong></td>
                <td align="right"><strong> $<span
                            id="ballpark_down">{{ number_format($project->getEstimatedInvestment($project->id) * 0.9, 2, '.', ',') }}</span></strong>
                </td>
                @for ($i = 1; $i <= $project->number_months; $i++)
                    <td></td>
                @endfor
            </tr>

        </tbody>
    </table>


    <script>
        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }

        function sendData(id, value, month, number) {
            //console.log(id, value.trim(), month, number);
            if (value > number) {

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Cantidad no válida',
                });

                console.log(number);
                var element = document.getElementById('c' + id);
                element.textContent = number;
                var event = new Event('change');
                element.dispatchEvent(event);

            } else if (value < 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Cantidad no debe ser menor a cero',
                });


                var element = document.getElementById('c' + id);
                element.textContent = 0;
                var event = new Event('change');
                element.dispatchEvent(event);
            } else {

                // Hacer la solicitud POST
                $.ajax({
                    url: "{{ url('project/send_data') }}/" + id,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        value: value.trim(),
                    },
                    success: function(data) {
                        $('#total' + month).text(data.total_hours);
                        $('#investment' + month).text(formatNumber(data.total_investment));
                        $('#estimated_investment').text(formatNumber(data.estimated_investment));
                        $('#ballpark_up').text(formatNumber(data.estimated_investment * 1.25));
                        $('#ballpark_down').text(formatNumber(data.estimated_investment * 0.9));
                        //ballpark_up
                        //console.log(data);
                    },
                    error: function(error) {
                        console.error('Error en la solicitud POST:', error);
                    }
                });

            }

        }

        function formatNumber(number) {
            return new Intl.NumberFormat('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }).format(number);
        }



    </script>

</div>
<div class="modal-footer">
    <a href="{{ url('project/set_sesion/5') }}">
        <button type="button" class="btn btn-primary">Next</button>
    </a>
</div>
