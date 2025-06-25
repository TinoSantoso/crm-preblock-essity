@extends('layouts.main')

@section('content')
<div class="demo-container">
    <div id="gridContainer"></div>
</div>

<script>
$(function() {
    const dummyData = [
        { name: "Alice Smith", email: "alice@example.com", phone: "123-456-7890" },
        { name: "Bob Johnson", email: "bob@example.com", phone: "234-567-8901" },
        { name: "Charlie Lee", email: "charlie@example.com", phone: "345-678-9012" },
        { name: "Diana King", email: "diana@example.com", phone: "456-789-0123" },
        { name: "Evan Wright", email: "evan@example.com", phone: "567-890-1234" },
        { name: "Fiona Green", email: "fiona@example.com", phone: "678-901-2345" },
        { name: "George Hall", email: "george@example.com", phone: "789-012-3456" },
        { name: "Hannah Young", email: "hannah@example.com", phone: "890-123-4567" },
        { name: "Ian Clark", email: "ian@example.com", phone: "901-234-5678" },
        { name: "Julia Adams", email: "julia@example.com", phone: "012-345-6789" }
    ];

    $("#gridContainer").dxDataGrid({
        dataSource: dummyData,
        height: 600,
        columns: [
            { dataField: "name", caption: "Customer Name" },
            { dataField: "email", caption: "Email" },
            { dataField: "phone", caption: "Phone" }
        ],
        filterRow: { visible: true },
        headerFilter: { visible: true },
        groupPanel: { visible: true },
        scrolling: { mode: "virtual" },
        paging: { pageSize: 10 },
        pager: {
            showPageSizeSelector: true,
            allowedPageSizes: [10, 20, 50]
        }
    });
});
</script>
@endsection