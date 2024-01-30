{{-- <tr align="center"> --}}
    <td align="left" colspan="4"><strong>Monthly Hrs</strong></td>
    @for ($i = 1; $i <= $project->number_months; $i++)
        <th>{{ $project->getTotalHours($project->id,$i)}}</th>
    @endfor
{{-- </tr> --}}
