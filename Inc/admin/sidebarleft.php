<div class="card">
                <div class="card-header">
                    <h4> Admin View </h4>
                </div>
                <div class="card-body">
                    <ul class="list-group">

                        <a
                            data-container="Dashboard_Container"
                            class="list-group-item side_hover container_change_click"
                        >
                            <i class="material-icons text-primary">dashboard</i>
                            Dashboard
                        </a>

                        <a
                            data-container="User_Container"
                            class="list-group-item side_hover container_change_click"
                        >
                            <i class="material-icons text-primary">supervised_user_circle</i>
                            User
                        </a>

                        <a
                            data-container="Ticket_Container"
                            class="list-group-item side_hover container_change_click"
                        >
                            <i class="material-icons text-primary">collections</i>
                            Ticket
                        </a>

                        <a
                            data-container="Order_Container"
                            class="list-group-item side_hover container_change_click"
                        >
                            <i class="material-icons text-primary">announcement</i>
                            Order
                        </a>


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