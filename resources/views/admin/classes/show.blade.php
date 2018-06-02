<div class="container">
    <div class="row">
        <div class="toppad" >


            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $class->name }}</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class=" col-md-12 col-lg-12">
                            <table class="table table-user-information">
                                <tbody>
                                <tr>
                                    <td>Title:</td>
                                    <td>{{ $class->name }}</td>
                                </tr>
                                <tr>
                                    <td>Description:</td>
                                    <td>{{ $class->description }}</td>
                                </tr>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
