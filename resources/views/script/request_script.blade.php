<script>
  $(document).ready(function () {
    sendRequestFun();
    receivedRequestFun();
    suggestionFun();
    connectionFun();

    //tabsWorking
        var previousActiveTabIndex = 0;

        $(".tab-switcher").on('click', function (event) {
        var tabClicked = $(this).data("tab_index");

        if(tabClicked != previousActiveTabIndex) {
            $("#content .tab_container").each(function () {
                if($(this).data("tab_index") == tabClicked) {
                    $(".tab_container").hide();
                    $(this).show();
                    previousActiveTabIndex = $(this).data("tab_index");
                    return;
                }
            });
        }
        });

        function suggestionFun()
        {
            //suggestionsShowAjaxCall
            var suggResult = "";
            $('#suggestions').empty();
            jQuery.ajax({
            url: "{{route('getSuggestion')}}",
                'dataType':'json',
                'method': 'get',
                'contentType': "application/json",
                success: function (data) {
                    $.each(data, function(key,value){
                        suggResult += `<tr>
                        <td class="align-middle">${value.name}</td>
                        <td class="align-middle"> - </td>
                        <td class="align-middle">${value.email}</td>
                        <td class="align-middle">
                        <td>
                            <button id="connect_btn_" class="btn btn-primary me-1" value="${value.id}">
                            Connect</button>
                        </td>
                        </tr>`;
                    });
                    $('#count_suggestions').html(data.length);
                    $('#suggestions').append(suggResult);
                }
            });    
        }
        
    //ConnectButton
        $('#suggestions').on('click', '#connect_btn_', function () {
            $(this).closest('tr').remove();
            var id = $(this).attr("value");
            var connectUrl  = "{{route('connect', ':id')}}";
            connectUrl = connectUrl.replace(':id', id);
            jQuery.ajax({
                url: connectUrl,
                'dataType':'json',
                'method': 'PUT',
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                'contentType': "application/json",
                success: function (data) {
                   
                }
            });
            newCount = parseFloat($('#count_suggestions').html()) - 1;
            $('#count_suggestions').html(newCount);
            $('#connect_btn_').click(sendRequestFun());
        });

    //sendRequestShowAjaxCall
        function sendRequestFun()
        {
            var sentResult = "";
            $('#sent_request').empty();
            jQuery.ajax({
            url: "{{route('sentRequest')}}",
                'dataType':'json',
                'method': 'get',
                'contentType': "application/json",
                success: function (data) {
                    $.each(data, function(key,value){
                    sentResult += `<tr>
                        <td class="align-middle">${value.name}</td>
                        <td class="align-middle"> - </td>
                        <td class="align-middle">${value.email}</td>
                        <td class="align-middle">
                        <td>
                        <button id="cancel_request_btn_" class="btn btn-danger" value="${value.id}">
                            Withdraw Request
                        </button>
                        </td>
                        </tr>`;
                    });
                    $('#count_sent').html(data.length);
                    $('#sent_request').append(sentResult);
                }
            });
        }
        
    //WithdrawRequestButton
        $('#sent_request').on('click', '#cancel_request_btn_', function () {
            $(this).closest('tr').remove();
            var id = $(this).attr("value");
            var url  = "{{route('delete', ':id')}}";
            url = url.replace(':id', id);
            jQuery.ajax({
                url: url,
                'dataType':'json',
                'method': 'DELETE',
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                'contentType': "application/json",
                success: function (data) {
                  
                }
            });
            newCount = parseFloat($('#count_sent').html()) - 1;
            $('#count_sent').html(newCount);
            $('#cancel_request_btn_').click(suggestionFun());
        });

    //ReceivedRequestShowAjaxCall
    function receivedRequestFun()
    {
        var receivedResult = "";
        $('#received_request').empty();

        jQuery.ajax({
            url: "{{route('receiveRequest')}}",
              'dataType':'json',
              'method': 'get',
              'contentType': "application/json",
              success: function (data) {
                $.each(data, function(key,value){
                    receivedResult += `<tr>
                        <td class="align-middle">${value.name}</td>
                        <td class="align-middle"> - </td>
                        <td class="align-middle">${value.email}</td>
                        <td class="align-middle">
                        <td>
                        <button id="received_request_btn_" class="btn btn-primary me-1" value="${value.id}">
                            Accept
                        </button>
                        </td>
                        </tr>`;
                    });
                    $('#count_received').html(data.length);
                    $('#received_request').append(receivedResult);
                }
            });
    }

    //AcceptRequestButton
        $('#received_request').on('click', '#received_request_btn_', function () {
            $(this).closest('tr').remove();

            var id = $(this).attr("value");
            var acceptReqUrl  = "{{route('edit', ':id')}}";
            acceptReqUrl = acceptReqUrl.replace(':id', id);

            jQuery.ajax({
                url: acceptReqUrl,
                'dataType':'json',
                'method': 'PUT',
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                'contentType': "application/json",
                success: function (data) {
                }
            });
            newCount = parseFloat($('#count_received').html()) - 1;
            $('#count_received').html(newCount);
            $('#received_request_btn_').click(connectionFun());
        });

    //ConnectionShowAjaxCall
    function connectionFun()
    {
        $('#connection_show').empty();
        var conResult = "";
        jQuery.ajax({
        url: "{{route('getConnection')}}",
            'dataType':'json',
            'method': 'get',
            'contentType': "application/json",
            success: function (data) {
            $.each(data, function(key,value){
                conResult += `<tr>
                    <td class="align-middle">${value.name}</td>
                    <td class="align-middle"> - </td>
                    <td class="align-middle">${value.email}</td>
                    <td>
                    <button style="width: 220px" value="${value.id}" id="get_connections_in_common_" class="btn btn-primary" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapse_" aria-expanded="false" aria-controls="collapseExample">
                        Connections in common (<span id="connections_in_common_count" ></span>)
                    </button>
                    <button id="remove_connection_btn_" value="${value.id}" class="btn btn-danger me-1">Remove Connection</button>
                    </td>
                    </tr>`;
                });
            $('#count_connections').html(data.length);
            $('#connection_show').append(conResult);
            }
        });
    }

        //ConnectionsInCommonButton
          $('#connection_show').on('click', '#get_connections_in_common_', function () {

            var id = $(this).attr("value");
            var comConUrl  = "{{route('getConnectionByID', ':id')}}";
            comConUrl = comConUrl.replace(':id', id);

            jQuery.ajax({
                url: comConUrl,
                'dataType':'json',
                'method': 'get',
                'contentType': "application/json",
                success: function (data) {
                   $.each(data.data, function(key,value){
                    $('#common_connection').append(value.name + "-" + value.email + "<br>");
                   });
                   $('#connections_in_common_count').html(data.data.length);
                }
            });
        });

        
    //RemoveConnectionButton
        $('#connection_show').on('click', '#remove_connection_btn_', function () {
            $(this).closest('tr').remove();

            var id = $(this).attr("value");
            var delConUrl  = "{{route('deleteConnection', ':id')}}";
            delConUrl = delConUrl.replace(':id', id);

            jQuery.ajax({
                url: delConUrl,
                'dataType':'json',
                'method': 'DELETE',
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                'contentType': "application/json",
                success: function (data) {
                }
            });
            newCount = parseFloat($('#count_connections').html()) - 1;
            $('#count_connections').html(newCount);
            $('#remove_connection_btn_').click(suggestionFun());
        });
});
</script>