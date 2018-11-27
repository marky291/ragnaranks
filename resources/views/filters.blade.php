@extends('layouts.frame')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8">
                <div class="sorting">
                    <span>Sorting:</span>
                    <div class="sorting-scroll">
                        <div class="sorting-inner">
                            <select name="" id="">
                                <option value="">Server Modes</option>
                            </select>
                            <select name="" id="">
                                <option value="">Server Types</option>
                            </select>
                            <select name="" id="">
                                <option value="">Popularity</option>
                            </select>
                            <select name="" id="">
                                <option value="">Country</option>
                            </select>
                            <select name="" id="">
                                <option value="">New Server</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="server-ranking">

                    @include('partials.cards')

                    @include('partials.cards')

                    <div class="server-ads">
                        <img src="img/ads.jpg" alt="">
                    </div>

                    @include('partials.cards')

                    @include('partials.cards')

                </div>

            </div>
            <div class="col-md-12 col-lg-4">

                <div class="box newest-servers">
                    <div class="box-body">
                        <div id="newservers-slider" class="newservers" data-speed="5000">
                            <div class="new-server text-center">
                                <div class="new-server-header">
                                    <h3 class="mb-0">Delta Ragnarok Online</h3>
                                    <small class="subheading">Joined 2 days ago..</small>
                                </div>
                                <div class="new-server-body">
                                    <p>We, at DeltaRO, aim to be the best Ragnarok server out there and we will cater each player with utmost respect and fair play. We want to give the best Ragnarok gaming experience!</p>
                                </div>
                            </div>
                            <div class="new-server text-center">
                                <div class="new-server-header">
                                    <h3 class="mb-0">Delta Ragnarok Online</h3>
                                    <small class="subheading">Joined 2 days ago..</small>
                                </div>
                                <div class="new-server-body">
                                    <p>We, at DeltaRO, aim to be the best Ragnarok server out there and we will cater each player with utmost respect and fair play. We want to give the best Ragnarok gaming experience!</p>
                                </div>
                            </div>
                            <div class="new-server text-center">
                                <div class="new-server-header">
                                    <h3 class="mb-0">Delta Ragnarok Online</h3>
                                    <small class="subheading">Joined 2 days ago..</small>
                                </div>
                                <div class="new-server-body">
                                    <p>We, at DeltaRO, aim to be the best Ragnarok server out there and we will cater each player with utmost respect and fair play. We want to give the best Ragnarok gaming experience!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button class="new-server-prev"><i class="fas fa-angle-left"></i></button>
                        Newest Server
                        <button class="new-server-next"><i class="fas fa-angle-right"></i></button>
                    </div>
                </div>

                <h3 class="box-title">
                    Latest Reviews
                    <select name="" id="" class="subheading">
                        <option value="">Latest</option>
                        <option value="">Highest</option>
                    </select>
                </h3>
                <div class="box latest-reviews">
                    <ul class="list-group">
                        <li class="list-group-item latest-review">
                            <a href="">DreamerRO Renewal-ish</a>
                            <ul>
                                <li><i class="fas fa-server"></i> High Rate</li>
                                <li><i class="fas fa-clock"></i> 2 hours ago</li>
                            </ul>
                            <div class="reviews appear"><span class="countTo" data-count="100">0</span></div>
                        </li>
                        <li class="list-group-item latest-review">
                            <a href="">DreamerRO Renewal-ish</a>
                            <ul>
                                <li><i class="fas fa-server"></i> High Rate</li>
                                <li><i class="fas fa-clock"></i> 2 hours ago</li>
                            </ul>
                            <div class="reviews appear"><span class="countTo" data-count="75">0</span></div>
                        </li>
                        <li class="list-group-item latest-review">
                            <a href="">DreamerRO Renewal-ish</a>
                            <ul>
                                <li><i class="fas fa-server"></i> High Rate</li>
                                <li><i class="fas fa-clock"></i> 2 hours ago</li>
                            </ul>
                            <div class="reviews appear"><span class="countTo" data-count="60">0</span></div>
                        </li>
                        <li class="list-group-item latest-review">
                            <a href="">DreamerRO Renewal-ish</a>
                            <ul>
                                <li><i class="fas fa-server"></i> High Rate</li>
                                <li><i class="fas fa-clock"></i> 2 hours ago</li>
                            </ul>
                            <div class="reviews appear"><span class="countTo" data-count="80">0</span></div>
                        </li>
                    </ul>
                </div>

                <h3 class="box-title">Website Statistics</h3>
                <div class="box widget-box">
                    <div class="widget-stat br-1 bb-1 appear">
                        <div class="countTo" data-count="128151">0</div>
                        <small class="subheading">Average <strong>Vistors</strong></small>
                    </div>
                    <div class="widget-stat bb-1 appear">
                        <div class="countTo" data-count="128151">0</div>
                        <small class="subheading">Active <strong>Servers</strong></small>
                    </div>
                    <div class="widget-stat br-1 appear">
                        <div class="countTo" data-count="128151">0</div>
                        <small class="subheading">Average <strong>in</strong> Clicks</small>
                    </div>
                    <div class="widget-stat appear">
                        <div class="countTo" data-count="128151">0</div>
                        <small class="subheading">Average <strong>Out</strong> Clicks</small>
                    </div>
                </div>

                <h3 class="box-title">Social Network</h3>
                <div class="social-networks d-flex">
                    <a href="" class="twitter"><i class="fab fa-twitter-square"></i> <span>Twitter</span></a>
                    <a href="" class="discord"><i class="fab fa-discord"></i> <span>Discord</span></a>
                </div>

                <div class="facebook">
                    <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FEADevOfficial%2F&tabs=timeline&width=350&height=256&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=508842139484989" width="350" height="256" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                </div>
            </div>
        </div>
    </div>

@endsection