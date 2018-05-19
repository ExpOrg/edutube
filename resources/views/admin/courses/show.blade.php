<div class="container">
    <div class="row">
        <div class="toppad" >


            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $course->title }}</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3" align="center"> <img alt="User Pic" src="{{ asset($course->image) }}" class="img-circle img-responsive" style="height: 100px; width: 100px"> </div>

                        <div class=" col-md-9 col-lg-9 ">
                            <table class="table table-user-information">
                                <tbody>
                                <tr>
                                    <td>Title:</td>
                                    <td>{{ $course->title }}</td>
                                </tr>
                                <tr>
                                    <td>Sub Title:</td>
                                    <td>{{ $course->sub_title }}</td>
                                </tr>
                                <tr>
                                    <td>Status:</td>
                                    <td>{{ ucfirst(trans("$course->status")) }}</td>
                                </tr>
                                <tr>
                                    <td>Language</td>
                                    <td>{{ $course->language }}</td>
                                </tr>

                                <tr>
                                <tr>
                                    <td>Price Currency</td>
                                    <td>{{ $course->price_currency }}</td>
                                </tr>
                                <tr>
                                    <td>Price</td>
                                    <td>{{ $course->price }}</td>
                                </tr>
                                <tr>
                                    <td>Discount Currency</td>
                                    <td>{{ $course->discount_currency }}</td>
                                </tr>
                                <tr>
                                    <td>Welcome Message</td>
                                    <td>{{ $course->welcome_message }}</td>
                                </tr>
                                <tr>
                                    <td>Congratulation Message</td>
                                    <td>{{ $course->congratulation_message }}</td>
                                </tr>
                                <td>Description</td>
                                <td>{{ strip_tags($course->description) }}</td>

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