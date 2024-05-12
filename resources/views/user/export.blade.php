<?php if ($users != '') {  ?>
    <?php if (isset($users)) { ?>
    <?php if (count($users) > 0) { ?>
<table>
    <thead>
        <tr>

            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Address</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1 @endphp

        @foreach ($users as $user)
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->mobile }}</td>
                <td>{{ $user->address }}</td>
            </tr>
            @php $no++ @endphp

        @endforeach
    </tbody>
</table>
<?php } else { echo "<center><hr>No Data available!</center>";}  ?>
<?php } ?>
<?php } ?>
