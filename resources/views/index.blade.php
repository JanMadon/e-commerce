sadf

<form action="/checkout" method="POST">
    @csrf
            <!-- <input type="hidden" name="_token" value="{{csrf_token()}}"> -->
            <input type="text">
            <button type="submit">checkout</button>
    </form>
        