<style>
    body {
        font-family: 'Open Sans', Arial, Helvetica, sans-serif;
        font-size: 12px;
    }

    .title {
        font-weight: bold;
        font-size: 14px;
        color: #FFF;
    }

    p {
        text-align: justify;
    }
</style>

<style>
    table {
        width: 100%;
        border-collapse: collapse;
        border-radius: 16px;
        /* Set the border-radius for rounded corners */
        overflow: hidden;
        /* Ensure rounded corners are applied */
        border: 2px solid #036;
    }

    th,
    td {
        border: 1px solid #036;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }
</style>

<style>
    .bg_td {
        background-color: #036
    }
</style>



<table class="table_principal" width="100%" border="1" cellspacing="0" cellpadding="0">
    <tr>
        <td width="25%" class="title bg_td">Engagement Title</td>
        <td width="75%">{{ $project->title }}</td>
    </tr>
    <tr>
        <td class="title bg_td">Level of Confidence </td>
        <td>{{ $levels[$project->level_confidence] }}</td>
    </tr>
    <tr>
        <td class="title bg_td">Requestor</td>
        <td>{{ $project->requestor }}</td>
    </tr>
    <tr>
        <td class="title bg_td">Estimator</td>
        <td>{{ $project->estimator }}</td>
    </tr>
    <tr>
        <td class="title bg_td">Engagement Summary</td>
        <td style="text-align: justify;"><?php echo $project->summary; ?></td>
    </tr>
    <tr>
        <td class="title bg_td">Version</td>
        <td>{{ $project->version }}</td>
    </tr>
</table>
<br />
<table style="width:100%">
    <thead>
        <tr>
            <th class="bg_td title">Role</th>
            <th class="bg_td title">HR</th>
            <th class="bg_td title">HA</th>
            <th class="bg_td title">amount</th>

            {{-- <th width="25%">Opciones</th> --}}
        </tr>
    </thead>
    <tbody>

        @foreach ($roles as $role)
            <tr>

                <td>{{ $role->name }}</td>
                <td>{{ $role->hr }}</td>
                <td>{{ $role->ha }}</td>
                {{-- <td>{{ $role->number != null ? $role->number : '' }}</td> --}}
                <td>
                    {{ $role->number != null ? $role->number : '' }}
                </td>

            </tr>
        @endforeach

    </tbody>
</table>

<div style="page-break-after: always;"></div>




<table class="table">
    <thead>
        <tr align="center">
            <th class="title bg_td">Role</th>
            <th class="title bg_td">Hourly Rate</th>
            <th class="title bg_td">HR/Day</th>
            <th class="title bg_td">Resourse</th>
            @for ($i = 1; $i <= $project->number_months; $i++)
                <th class="title bg_td">Mes{{ $i }}</th>
            @endfor
        </tr>
    </thead>
    <tbody>
        @foreach ($project->team as $team)
            <tr align="center">
                <td align="left"><strong>{{ $team->project_role->name }}</strong>
                </td>
                <td>{{ $team->project_role->hr }}</td>
                <td>{{ $team->project_role->ha }}</td>
                <td>{{ $team->number }}</td>
                @foreach ($team->getData($project->id, $team->project_role_id) as $data)
                    <td>
                        {{ $data->value }}</td>
                @endforeach

            </tr>
        @endforeach

        <tr align="center">
            <td align="left" colspan="4"><strong>Monthly Hrs</strong></td>
            @for ($i = 1; $i <= $project->number_months; $i++)
                <th >
                        {{ $project->getTotalHours($project->id, $i) }}</th>
            @endfor

        </tr>


        <tr align="center">
            <td align="left" colspan="4"><strong>Monthly Investment</strong></td>
            @for ($i = 1; $i <= $project->number_months; $i++)
                <th class="table_border">
                        ${{ number_format($project->getMonthlyInvestment($project->id, $i), 2, '.', ',') }}
                   </th>
            @endfor

        </tr>

        <tr align="center">
            <td align="left" colspan="3"><strong>Estimated Investment</strong>
            </td>
            <td align="right"><strong> ${{ number_format($project->getEstimatedInvestment($project->id), 2, '.', ',') }}</strong>
            </td>
            @for ($i = 1; $i <= $project->number_months; $i++)
                <td></td>
            @endfor

        </tr>

        <tr align="center">
            <td align="left" colspan="3"><strong>Ballpark up +</strong></td>
            <td align="right"><strong> ${{ number_format($project->getEstimatedInvestment($project->id) * 1.25, 2, '.', ',') }}</strong>
            </td>
            @for ($i = 1; $i <= $project->number_months; $i++)
                <td></td>
            @endfor

        </tr>

        <tr align="center" id="totales">
            <td align="left" colspan="3"><strong>Ballpark down -</strong></td>
            <td align="right"><strong> ${{ number_format($project->getEstimatedInvestment($project->id) * 0.9, 2, '.', ',') }}</strong>
            </td>
            @for ($i = 1; $i <= $project->number_months; $i++)
                <td></td>
            @endfor
        </tr>

    </tbody>
</table>



<div style="page-break-after: always;"></div>










<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col" class="title bg_td">Secure Development Practice</th>
            <th scope="col" class="title bg_td">Required</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($security_requirements as $requirement)
            @php($value_requirement = $requirement->getRequirement($requirement->id, $project->id))
            <tr>
                <td>{{ $requirement->description }}</td>
                <td><label class="switch">
                        <input type="checkbox"
                            onchange="sendDataRequirement({{ $requirement->id }},{{ $project->id }})"
                            id="requirement{{ $requirement->id }}" {{ $value_requirement === '1' ? 'checked' : '' }}>
                        <span class="slider round"></span>
                    </label></td>
            </tr>
        @endforeach
    </tbody>
</table>
<div style="page-break-after: always;"></div>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
    <tr>
        <td class="title bg_td">Assumptions</td>
    </tr>
    <tr>
        <td style="text-align: justify;"><?php echo $project->assumptions; ?></td>
    </tr>
</table>
