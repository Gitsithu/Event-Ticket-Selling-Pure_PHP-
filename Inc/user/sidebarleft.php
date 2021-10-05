<div class="card">
                <div class="card-header">
                    <h4> User View </h4>
                </div>
                <div class="card-body">
                    <ul class="list-group">

                        <a
                            data-container="Ticket_Container"
                            class="list-group-item side_hover container_change_click"
                        >
                            <i class="material-icons text-primary">dashboard</i>
                            Ticket
                        </a>
                       
                        <a
                            data-container="Order_Container"
                            class="list-group-item side_hover container_change_click"
                        >
                            <i class="material-icons text-primary">collections</i>
                            Order
                        </a>

                        <!-- <a
                            data-container="Coming_Soon_Container"
                            class="list-group-item side_hover container_change_click"
                        >
                            <i class="material-icons text-primary">youtube_searched_for</i>
                            By City
                            <span class="coming_soon"> New! </span>
                        </a> -->

                        <a
                            data-container="Profile_Container"
                            class="list-group-item side_hover container_change_click"
                        >
                            <i class="material-icons text-primary">person_pin</i>
                            Profile
                        </a>

                    </ul>
                </div>
                <div class="card-footer text-muted">
                    <a href="<?= URL ?>/logout" class="btn btn-danger toLogout"> Logout </a>
                </div>
</div>