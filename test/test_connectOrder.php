<!DOCTYPE html>
<html>
<body>

<h2>Using the XMLHttpRequest Object</h2>

<div id="demo">
    <button type="button" onclick="loadXMLDoc()">Change Content</button>
</div>

<script type="text/javascript">
    /*
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function()
    {
        if( xhr.readyState==4 && xhr.status==200 )
        {
            console.log(xhr.responseText);
        }
    }
    var json = {
        'postOrderId': '1541742824hezhi',
        'requestOrderId': '1541554181linzhe'

    };
    xhr.open("POST","http://web.engr.oregonstate.edu/~hezhi/api/connect_orders.php?view=confirmed");
    xhr.setRequestHeader("Content-Type","application/json;charset=utf-8");
    xhr.send(JSON.stringify(json));
    */
    /*
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function()
    {
        if( xhr.readyState==4 && xhr.status==200 )
        {
            console.log(xhr.responseText);
        }
    }
    var json = {
        'postOrderId': '2345678',
        'userId': 'linzhe',
        'requestOrderId': '123456789',

    };
    xhr.open("POST","http://web.engr.oregonstate.edu/~hezhi/api/connect_orders.php?view=postWaitList");
    xhr.setRequestHeader("Content-Type","application/json;charset=utf-8");
    xhr.send(JSON.stringify(json));
    */
    /*
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function()
    {
        if( xhr.readyState==4 && xhr.status==200 )
        {
            console.log(xhr.responseText);
        }
    }
    var json = {
        'postOrderId': "123",
        'requestOrderId': "1541554108",
        'userId': "linzhe",

    };
    xhr.open("POST","http://web.engr.oregonstate.edu/~hezhi/api/connect_orders.php?view=newRequestWaitList");
    xhr.setRequestHeader("Content-Type","application/json;charset=utf-8");
    xhr.send(JSON.stringify(json));
    */
    /*
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function()
    {
        if( xhr.readyState==4 && xhr.status==200 )
        {
            console.log(xhr.responseText);
        }
    }
    var json = {
        'postOrderId': '2345678',
        'userId': 'linzhe',
        'requestOrderId': '123456789',

    };
    xhr.open("POST","http://web.engr.oregonstate.edu/~hezhi/api/connect_orders.php?view=deleteRequestWaitList");
    xhr.setRequestHeader("Content-Type","application/json;charset=utf-8");
    xhr.send(JSON.stringify(json));
    */
    /*
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function()
    {
        if( xhr.readyState==4 && xhr.status==200 )
        {
            console.log(xhr.responseText);
        }
    }
    var json = {
        'postOrderId': '1541742824hezhi',
        'requestOrderId': '1541554181linzhe',

    };
    xhr.open("POST","http://web.engr.oregonstate.edu/~hezhi/api/connect_orders.php?view=deleteConfirmed");
    xhr.setRequestHeader("Content-Type","application/json;charset=utf-8");
    xhr.send(JSON.stringify(json));
    */
    /*
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function()
    {
        if( xhr.readyState==4 && xhr.status==200 )
        {
            console.log(xhr.responseText);
        }
    }
    var json = {

        'post_userid' : 'linzhe',
        'departure_location': '111 sw 222th st',
        'destination_location': 'portland',
        'departure_time': '2018-11-07 16:34:11',
        'post_time': '2018-11-07 16:34:22',
        'remarks' : 'test',
        'available_seats': '4',
        'available': '2',
        'finished': '1',
        'departure_city':'convallis',
        'departure_state':'oregon',
        'destination_city':'portland',
        'destination_state':'oregon',

    };
    xhr.open("POST","http://web.engr.oregonstate.edu/~hezhi/api/connect_orders.php?view=newPostAndConnect&requestOrderId=123456");
    xhr.setRequestHeader("Content-Type","application/json;charset=utf-8");
    xhr.send(JSON.stringify(json));
    */
    /*
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function()
    {
        if( xhr.readyState==4 && xhr.status==200 )
        {
            console.log(xhr.responseText);
        }
    }
    var json = {

        'request_userid' : 'linzhe',
        'departure_location': '111 sw 222th st',
        'destination_location': 'portland',
        'departure_time': '2018-11-07 16:34:11',
        'post_time': '2018-11-07 16:34:22',
        'remarks' : 'test',
        'people_number': '4',
        'available': '2',
        'finished': '1',
        'departure_city':'convallis',
        'departure_state':'OR',
        'destination_city':'portland',
        'destination_state':'OR',

    };
    xhr.open("POST","http://web.engr.oregonstate.edu/~hezhi/api/connect_orders.php?view=newRequestAndConnect&postOrderId=123456");
    xhr.setRequestHeader("Content-Type","application/json;charset=utf-8");
    xhr.send(JSON.stringify(json));
    */

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function()
    {
        if( xhr.readyState==4 && xhr.status==200 )
        {
            console.log(xhr.responseText);
        }
    }
    xhr.open("GET","http://web.engr.oregonstate.edu/~hezhi/api/connect_orders.php?view=readPostWaitListForDriver&postOrderId=1541742824hezhi");
    xhr.setRequestHeader("Content-Type","application/json;charset=utf-8");
    xhr.send();
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function()
    {
        if( xhr.readyState==4 && xhr.status==200 )
        {
            console.log(xhr.responseText);
        }
    }
    xhr.open("GET","http://web.engr.oregonstate.edu/~hezhi/api/connect_orders.php?view=readRequestWaitListForPassenger&requestOrderId=1541554181hezhi");
    xhr.setRequestHeader("Content-Type","application/json;charset=utf-8");
    xhr.send();

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function()
    {
        if( xhr.readyState==4 && xhr.status==200 )
        {
            console.log(xhr.responseText);
        }
    }
    xhr.open("GET","http://web.engr.oregonstate.edu/~hezhi/api/connect_orders.php?view=readRequestWaitListForDriver&postOrderId=1541827825chenk5");
    xhr.setRequestHeader("Content-Type","application/json;charset=utf-8");
    xhr.send();
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function()
    {
        if( xhr.readyState==4 && xhr.status==200 )
        {
            console.log(xhr.responseText);
        }
    }
    xhr.open("GET","http://web.engr.oregonstate.edu/~hezhi/api/connect_orders.php?view=readPostWaitListForPassenger&requestOrderId=1541893338chenk5");
    xhr.setRequestHeader("Content-Type","application/json;charset=utf-8");
    xhr.send();
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function()
    {
        if( xhr.readyState==4 && xhr.status==200 )
        {
            console.log(xhr.responseText);
        }
    }
    xhr.open("GET","http://web.engr.oregonstate.edu/~hezhi/api/connect_orders.php?view=readRequestWaitListForPassenger&requestOrderId=1541978131chenk5");
    xhr.setRequestHeader("Content-Type","application/json;charset=utf-8");
    xhr.send();
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function()
    {
        if( xhr.readyState==4 && xhr.status==200 )
        {
            console.log(xhr.responseText);
        }
    }
    xhr.open("GET","http://web.engr.oregonstate.edu/~hezhi/api/connect_orders.php?view=readPostWaitListForPassenger&requestOrderId=1541926244linzhe");
    xhr.setRequestHeader("Content-Type","application/json;charset=utf-8");
    xhr.send();


    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function()
    {
        if( xhr.readyState==4 && xhr.status==200 )
        {
            console.log(xhr.responseText);
        }
    }
    xhr.open("GET","http://web.engr.oregonstate.edu/~hezhi/api/connect_orders.php?view=readConfirmedOrderForPassenger&userId=chenk5");
    xhr.setRequestHeader("Content-Type","application/json;charset=utf-8");
    xhr.send();


    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function()
    {
        if( xhr.readyState==4 && xhr.status==200 )
        {
            console.log(xhr.responseText);
        }
    }
    xhr.open("GET","http://web.engr.oregonstate.edu/~hezhi/api/connect_orders.php?view=readUnconfirmedOrderForPassenger&userId=linzhe");
    xhr.setRequestHeader("Content-Type","application/json;charset=utf-8");
    xhr.send();


    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function()
    {
        if( xhr.readyState==4 && xhr.status==200 )
        {
            console.log(xhr.responseText);
        }
    }
    xhr.open("GET","http://web.engr.oregonstate.edu/~hezhi/api/connect_orders.php?view=readConfirmedOrderForRequestOrderId&requestOrderId=1541893338chenk5");
    xhr.setRequestHeader("Content-Type","application/json;charset=utf-8");
    xhr.send();

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function()
    {
        if( xhr.readyState==4 && xhr.status==200 )
        {
            console.log(xhr.responseText);
        }
    }
    xhr.open("GET","http://web.engr.oregonstate.edu/~hezhi/api/connect_orders.php?view=readConfirmedOrderForPostOrderId&postOrderId=1543561111chenk5");
    xhr.setRequestHeader("Content-Type","application/json;charset=utf-8");
    xhr.send();

</script>

</body>
</html>
