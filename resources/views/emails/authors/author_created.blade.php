<style>
    td {
        padding: 12px;
        text-align: center
    }
    table, tr, th, td {
        padding: 12px;
        border: 1px solid #212121;
        border-collapse: collapse;
    }
</style>
<div>
    <p>
        <strong>Hi Dear Administrator</strong>,<br>
        <em>Recently an Author was created.</em>
    </p>
    <table>
        <thead>
        <tr>
            <th class="">ID</th>
            <th class="">Name</th>
            <th class="">Family</th>
            <th class="">Full Name</th>
            <th class="">Email</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{$author->id}}</td>
            <td>{{$author->name}}</td>
            <td>{{$author->family}}</td>
            <td>{{$author->full_name}}</td>
            <td>{{$author->email}}</td>
        </tr>
        </tbody>
    </table>
    ______________________________________________________________ <br><br>
    Time: <strong>{{$author->created_at->format('y,M,d H:i:s')}}</strong><br>
    Current time: <strong>{{now()->format('y,M,d H:i:s')}}</strong>
</div>
