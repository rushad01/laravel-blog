<x-layout>
    <div class="col-md-12 col-sm-12">
        <div class="col" id="chat">
        </div>
        <div class="container">
            <form action="/chat" method="POST" class="form-group">
                @csrf
                <input type="text" class="form-control" name="chatmessage" placeholder="Type your message">
                <button type="submit" class="btn btn-primary"><i class="fas fa-arrow-right"></i></button>        
            </form>
        </div>
    </div>
</x-layout>