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
        'postOrderId': '2345678',
        'requestOrderId': '123456789',

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
    xhr.open("POST","http://web.engr.oregonstate.edu/~hezhi/api/connect_orders.php?view=requestWaitList");
    xhr.setRequestHeader("Content-Type","application/json;charset=utf-8");
    xhr.send(JSON.stringify(json));

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
        'requestOrderId': '123456789',

    };
    xhr.open("POST","http://web.engr.oregonstate.edu/~hezhi/api/connect_orders.php?view=deleteConfirmed");
    xhr.setRequestHeader("Content-Type","application/json;charset=utf-8");
    xhr.send(JSON.stringify(json));

</script>

</body>
</html>
