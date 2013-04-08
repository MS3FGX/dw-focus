<?php
/**
 * Template Name: Typography
 *
 * @package DW Focus
 * @since DW Focus 1.0
 */

get_header(); ?>
    <div id="primary" class="site-content span12">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <h1 class="entry-title"><?php the_title(); ?></h1>
            </header><!-- .entry-header -->

            <div class="entry-content">
                <p class="dropcap">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vel metus ac nisl scelerisque placerat id vel libero. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse eget massa urna, ac ornare purus. Pellentesque pellentesque accumsan libero, at porta risus tempor eget. Suspendisse erat massa, tincidunt ut tristique quis, tincidunt in justo. Sed nec urna massa.</p>

                <div class="bs-docs-grid">
                    <div class="row show-grid">
                        <div class="span1">1</div>
                        <div class="span1">1</div>
                        <div class="span1">1</div>
                        <div class="span1">1</div>
                        <div class="span1">1</div>
                        <div class="span1">1</div>
                        <div class="span1">1</div>
                        <div class="span1">1</div>
                        <div class="span1">1</div>
                        <div class="span1">1</div>
                        <div class="span1">1</div>
                        <div class="span1">1</div>
                    </div>
                    <div class="row show-grid">
                        <div class="span4">4</div>
                        <div class="span4">4</div>
                        <div class="span4">4</div>
                    </div>
                    <div class="row show-grid">
                        <div class="span4">4</div>
                        <div class="span8">8</div>
                    </div>
                    <div class="row show-grid">
                        <div class="span6">6</div>
                        <div class="span6">6</div>
                    </div>
                    <div class="row show-grid">
                        <div class="span12">12</div>
                    </div>
                </div>

                <div class="row typo">
                    <div class="span5">
                        <div class="page-header">
                            <h2>Heading</h2>
                        </div>
                        <h1>This is heading 1</h1>
                        <h2>This is heading 2</h2>
                        <h3>This is heading 3</h3>
                        <h4>This is heading 4</h4>
                        <h5>This is heading 5</h5>
                        <h6>This is heading 6</h6>
                    </div>
                    <div class="span4">
                        <div class="page-header">
                            <h2>Labels</h2>
                        </div>
                        <p><span class="label">Default</span> Lorem ipsum dolor sit amet.</p>
                        <p><span class="label label-success">Success</span> Lorem ipsum dolor sit amet.</p>
                        <p><span class="label label-warning">Warning</span> Lorem ipsum dolor sit amet.</p>
                        <p><span class="label label-important">Important</span> Lorem ipsum dolor sit amet.</p>
                        <p><span class="label label-info">Info</span> Lorem ipsum dolor sit amet.</p>
                        <p><span class="label label-inverse">Inverse</span> Lorem ipsum dolor sit amet.</p>
                    </div>
                    <div class="span3">
                        <div class="page-header">
                            <h2>Badges</h2>
                        </div>
                        <p><span class="badge">1</span> Lorem ipsum dolor sit amet.</p>
                        <p><span class="badge badge-success">2</span> Lorem ipsum dolor sit amet.</p>
                        <p><span class="badge badge-warning">4</span> Lorem ipsum dolor sit amet.</p>
                        <p><span class="badge badge-important">6</span> Lorem ipsum dolor sit amet.</p>
                        <p><span class="badge badge-info">8</span> Lorem ipsum dolor sit amet.</p>
                        <p><span class="badge badge-inverse">10</span> Lorem ipsum dolor sit amet.</p>
                    </div>
                </div>

                <div class="page-header">
                    <h2>Buttons</h2>
                </div>
                <div class="row">
                    <div class="span6">
                        <div class="row-fluid default-buttons">
                            <button class="btn" type="button">Default</button>
                            <input class="btn btn-primary" type="submit" value="Primary" />
                            <input class="btn btn-info" type="button" value="Info" />
                            <a class="btn btn-success" href="#">Success</a>
                            <button class="btn btn-warning" type="button">Warning</button>
                            <input class="btn btn-danger" type="submit" value="Danger" />
                            <input class="btn btn-inverse" type="button" value="Inverse" />
                            <a class="btn btn-link" href="#">Link</a>
                        </div>

                        <div class="button-size row-fluid">
                            <button class="btn btn-mini" type="button">Mini</button>
                            <button class="btn btn-small" type="button">Small</button>
                            <button class="btn" type="button">Default</button>
                            <button class="btn btn-large" type="button">Large</button>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="row-fluid button-group">
                            <div class="btn-group">
                              <button class="btn">Left</button>
                              <button class="btn">Middle</button>
                              <button class="btn">Right</button>
                            </div>
                            <div class="btn-toolbar">
                              <div class="btn-group">
                                <button class="btn">1</button>
                                <button class="btn">2</button>
                                <button class="btn">3</button>
                                <button class="btn">4</button>
                              </div>
                              <div class="btn-group">
                                <button class="btn">5</button>
                                <button class="btn">6</button>
                              </div>
                              <div class="btn-group">
                                <button class="btn">7</button>
                              </div>
                            </div>
                        </div>

                        <div class="well">
                          <button class="btn btn-large btn-block btn-primary" type="button">Block level button</button>
                          <button class="btn btn-large btn-block" type="button">Block level button</button>
                        </div>
                    </div>
                </div>

                <div class="page-header">
                    <h2>Alerts</h2>
                </div>
                <div class="row">
                    <div class="span6">
                        <div class="alert alert-error">
                            <button data-dismiss="alert" type="button" class="close">&times;</button>
                            <strong>Oh snap!</strong> Change a few things up and try submitting again. 
                        </div>
                    </div>
                    <div class="span6">
                        <div class="alert alert-alert">
                            <button data-dismiss="alert" type="button" class="close">&times;</button>
                            <strong>Warning!</strong> Best check yo self, you're not looking too good.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="span6">
                        <div class="alert alert-success">
                            <button data-dismiss="alert" type="button" class="close">&times;</button>
                            <strong>Well done!</strong> You successfully read this important alert message. 
                            </div>
                        </div>
                    <div class="span6">
                        <div class="alert alert-info">
                            <button data-dismiss="alert" type="button" class="close">&times;</button>
                            <strong>Heads up!</strong> This alert needs your attention, but it's not important. 
                        </div>
                    </div>
                </div>

                <div class="page-header">
                    <h2>Block quotes</h2>
                </div>
                <div class="row">
                    <div class="span6">
                        <blockquote>
                        <p>This is a sample <strong>Blockquote</strong>. Lorem ipsum dolor sit amet consectetuer rutrum dignissim et neque id. Interdum pharetra in a metus congue In Sed Pellentesque tincidunt pharetra.</p>
                        <small>Someone famous <cite title="Source Title">Source Title</cite></small>
                        </blockquote>
                    </div>

                    <div class="span6">
                        <blockquote class="red">
                        <p>This is a sample <strong>Blockquote</strong>. Lorem ipsum dolor sit amet consectetuer rutrum dignissim et neque id. Interdum pharetra in a metus congue In Sed Pellentesque tincidunt pharetra.</p>
                        <small>Someone famous <cite title="Source Title">Source Title</cite></small>
                        </blockquote>
                    </div>
                </div>  
                  
                <div class="row">
                    <div class="span6">
                        <div class="page-header">
                            <h2>Table</h2>
                        </div>
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>First Name</th>
                              <th>Last Name</th>
                              <th>Username</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>1</td>
                              <td>Mark</td>
                              <td>Otto</td>
                              <td>@mdo</td>
                            </tr>
                            <tr>
                              <td>2</td>
                              <td>Jacob</td>
                              <td>Thornton</td>
                              <td>@fat</td>
                            </tr>
                            <tr>
                              <td>3</td>
                              <td>Larry</td>
                              <td>the Bird</td>
                              <td>@twitter</td>
                            </tr>
                          </tbody>
                        </table>
                        <div class="page-header">
                            <h2>Tab</h2>
                        </div>
                        <ul id="myTab" class="nav nav-tabs">
                          <li class="active"><a href="#home" data-toggle="tab">Home</a></li>
                          <li><a href="#profile" data-toggle="tab">Profile</a></li>
                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                              <li><a href="#dropdown1" data-toggle="tab">@fat</a></li>
                              <li><a href="#dropdown2" data-toggle="tab">@mdo</a></li>
                            </ul>
                          </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div class="tab-pane fade in active" id="home">
                            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                          </div>
                          <div class="tab-pane fade" id="profile">
                            <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
                          </div>
                          <div class="tab-pane fade" id="dropdown1">
                            <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
                          </div>
                          <div class="tab-pane fade" id="dropdown2">
                            <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
                          </div>
                        </div>
                        <div class="page-header">
                            <h2>Accordion</h2>
                        </div>
                        <div id="accordion2" class="accordion">
                            <div class="accordion-group">
                              <div class="accordion-heading">
                                <a href="#collapseOne" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle active">
                                  Collapsible Group Item #1
                                </a>
                              </div>
                              <div class="accordion-body collapse in" id="collapseOne">
                                <div class="accordion-inner">
                                  Anim pariatur cliche reprehenderit,  terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                </div>
                              </div>
                            </div>
                            <div class="accordion-group">
                              <div class="accordion-heading">
                                <a href="#collapseTwo" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle">
                                  Collapsible Group Item #2
                                </a>
                              </div>
                              <div class="accordion-body collapse" id="collapseTwo">
                                <div class="accordion-inner">
                                  Anim pariatur cliche reprehenderit, terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                </div>
                              </div>
                            </div>
                            <div class="accordion-group">
                              <div class="accordion-heading">
                                <a href="#collapseThree" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle">
                                  Collapsible Group Item #3
                                </a>
                              </div>
                              <div class="accordion-body collapse" id="collapseThree">
                                <div class="accordion-inner">
                                  Anim pariatur cliche reprehenderit, terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="page-header">
                            <h2>Form</h2>
                        </div>
                        <form>
                            <label>Username</label>
                            <input type="text" class="span3" placeholder="Type something ..." />
                            <label>Password</label>
                            <input type="text" class="span3" placeholder="Type something ..." />
                            <span class="help-inline">Minimum of 6 characters in length</span>
                            <div class="control-group error">
                                <label>Email</label>
                                <div class="controls">
                                    <input type="text" class="span3" placeholder="Type something ..." />
                                    <span class="help-inline">Please correct the error</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="span3">
                                    <label>First name</label>
                                    <input type="text" class="span3" placeholder="Type something ..." />
                                </div>
                                <div class="span3">
                                    <label>Last name</label>
                                    <input type="text" class="span3" placeholder="Type something ..." />
                                </div>
                            </div>
                            <label>Disabled input</label>
                            <input class="span6" type="text" placeholder="Disabled input here..." disabled />
                            <label>Address</label>
                            <input type="text" class="span6" placeholder="Type something ..." />
                            <span class="help-block">A longer block of text that breaks onto a new line and may extend beyond one line.</span>
                            <div class="row">
                                <div class="span3">
                                    <label>City</label>
                                    <input type="text" class="span3" placeholder="Type something ..." />
                                </div>
                                <div class="span3">
                                    <label>Country</label>
                                    <select class="span3">
                                        <option>United States</option>
                                        <option>Viet Nam</option>
                                        <option>Japan</option>
                                        <option>Singapore</option>
                                        <option>Italia</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="span3">
                                    <label>Multiple select</label>
                                    <select multiple="multiple" class="span3">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                                <div class="span3">
                                    <label class="checkbox">
                                        <input type="checkbox" value="">
                                        Lorem ipsum dolor sit amet
                                    </label>
                                    <label class="checkbox">
                                        <input type="checkbox" value="">
                                        Nulla vel sapie justo lorem
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                        Cras venenatis vitae augue
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                        Nulla sed dui sit semper accumsan
                                    </label>
                                </div>
                            </div>
                            <label>Type your message</label>
                            <textarea rows="5" class="span6"></textarea>
                            <input type="submit" value="Submit" class="btn btn-primary">
                            <input type="reset" value="Reset" class="btn">
                        </form>
                    </div>
                </div>
                <div class="page-header">
                    <h2>Process bar</h2>
                </div>
                <div class="progress">
                    <div class="bar" style="width: 60%;"></div>
                </div>
                <div class="progress progress-striped">
                    <div class="bar" style="width: 20%;"></div>
                </div>
                <div class="progress progress-striped active">
                    <div class="bar" style="width: 40%;"></div>
                </div>
                <div class="progress">
                    <div class="bar bar-success" style="width: 35%;"></div>
                    <div class="bar bar-warning" style="width: 20%;"></div>
                    <div class="bar bar-danger" style="width: 10%;"></div>
                </div>
                <div class="row">
                    <div class="span6">
                        <div class="progress progress-info">
                            <div class="bar" style="width: 20%"></div>
                        </div>
                        <div class="progress progress-success">
                            <div class="bar" style="width: 40%"></div>
                        </div>
                        <div class="progress progress-warning">
                            <div class="bar" style="width: 60%"></div>
                        </div>
                        <div class="progress progress-danger">
                            <div class="bar" style="width: 80%"></div>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="progress progress-info progress-striped">
                            <div class="bar" style="width: 20%"></div>
                        </div>
                        <div class="progress progress-success progress-striped">
                            <div class="bar" style="width: 40%"></div>
                        </div>
                        <div class="progress progress-warning progress-striped">
                            <div class="bar" style="width: 60%"></div>
                        </div>
                        <div class="progress progress-danger progress-striped">
                            <div class="bar" style="width: 80%"></div>
                        </div>
                    </div>
                </div>
                
                <div class="page-header">
                    <h2>Icons</h2>
                </div>
                <ul class="the-icons clearfix">
                    <li><i class="icon-adjust"></i> icon-adjust</li>
                    <li><i class="icon-asterisk"></i> icon-asterisk</li>
                    <li><i class="icon-ban-circle"></i> icon-ban-circle</li>
                    <li><i class="icon-bar-chart"></i> icon-bar-chart</li>
                    <li><i class="icon-barcode"></i> icon-barcode</li>
                    <li><i class="icon-beaker"></i> icon-beaker</li>
                    <li><i class="icon-bell"></i> icon-bell</li>
                    <li><i class="icon-bolt"></i> icon-bolt</li>
                    <li><i class="icon-book"></i> icon-book</li>
                    <li><i class="icon-bookmark"></i> icon-bookmark</li>
                    <li><i class="icon-bookmark-empty"></i> icon-bookmark-empty</li>
                    <li><i class="icon-briefcase"></i> icon-briefcase</li>
                    <li><i class="icon-bullhorn"></i> icon-bullhorn</li>
                    <li><i class="icon-calendar"></i> icon-calendar</li>
                    <li><i class="icon-camera"></i> icon-camera</li>
                    <li><i class="icon-camera-retro"></i> icon-camera-retro</li>
                    <li><i class="icon-certificate"></i> icon-certificate</li>
                    <li><i class="icon-check"></i> icon-check</li>
                    <li><i class="icon-check-empty"></i> icon-check-empty</li>
                    <li><i class="icon-cloud"></i> icon-cloud</li>
                    <li><i class="icon-cog"></i> icon-cog</li>
                    <li><i class="icon-cogs"></i> icon-cogs</li>
                    <li><i class="icon-comment"></i> icon-comment</li>
                    <li><i class="icon-comment-alt"></i> icon-comment-alt</li>
                    <li><i class="icon-comments"></i> icon-comments</li>
                    <li><i class="icon-comments-alt"></i> icon-comments-alt</li>
                    <li><i class="icon-credit-card"></i> icon-credit-card</li>
                    <li><i class="icon-dashboard"></i> icon-dashboard</li>
                    <li><i class="icon-download"></i> icon-download</li>
                    <li><i class="icon-download-alt"></i> icon-download-alt</li>
                    <li><i class="icon-edit"></i> icon-edit</li>
                    <li><i class="icon-envelope"></i> icon-envelope</li>
                    <li><i class="icon-envelope-alt"></i> icon-envelope-alt</li>

                    <li><i class="icon-exclamation-sign"></i> icon-exclamation-sign</li>
                    <li><i class="icon-external-link"></i> icon-external-link</li>
                    <li><i class="icon-eye-close"></i> icon-eye-close</li>
                    <li><i class="icon-eye-open"></i> icon-eye-open</li>
                    <li><i class="icon-facetime-video"></i> icon-facetime-video</li>
                    <li><i class="icon-film"></i> icon-film</li>
                    <li><i class="icon-filter"></i> icon-filter</li>
                    <li><i class="icon-fire"></i> icon-fire</li>
                    <li><i class="icon-flag"></i> icon-flag</li>
                    <li><i class="icon-folder-close"></i> icon-folder-close</li>
                    <li><i class="icon-folder-open"></i> icon-folder-open</li>
                    <li><i class="icon-gift"></i> icon-gift</li>
                    <li><i class="icon-glass"></i> icon-glass</li>
                    <li><i class="icon-globe"></i> icon-globe</li>
                    <li><i class="icon-group"></i> icon-group</li>
                    <li><i class="icon-hdd"></i> icon-hdd</li>
                    <li><i class="icon-headphones"></i> icon-headphones</li>
                    <li><i class="icon-heart"></i> icon-heart</li>
                    <li><i class="icon-heart-empty"></i> icon-heart-empty</li>
                    <li><i class="icon-home"></i> icon-home</li>
                    <li><i class="icon-inbox"></i> icon-inbox</li>
                    <li><i class="icon-info-sign"></i> icon-info-sign</li>
                    <li><i class="icon-key"></i> icon-key</li>
                    <li><i class="icon-leaf"></i> icon-leaf</li>
                    <li><i class="icon-legal"></i> icon-legal</li>
                    <li><i class="icon-lemon"></i> icon-lemon</li>
                    <li><i class="icon-lock"></i> icon-lock</li>
                    <li><i class="icon-unlock"></i> icon-unlock</li>
                    <li><i class="icon-magic"></i> icon-magic</li>
                    <li><i class="icon-magnet"></i> icon-magnet</li>
                    <li><i class="icon-map-marker"></i> icon-map-marker</li>
                    <li><i class="icon-minus"></i> icon-minus</li>
                    <li><i class="icon-minus-sign"></i> icon-minus-sign</li>

                    <li><i class="icon-money"></i> icon-money</li>
                    <li><i class="icon-move"></i> icon-move</li>
                    <li><i class="icon-music"></i> icon-music</li>
                    <li><i class="icon-off"></i> icon-off</li>
                    <li><i class="icon-ok"></i> icon-ok</li>
                    <li><i class="icon-ok-circle"></i> icon-ok-circle</li>
                    <li><i class="icon-ok-sign"></i> icon-ok-sign</li>
                    <li><i class="icon-pencil"></i> icon-pencil</li>
                    <li><i class="icon-picture"></i> icon-picture</li>
                    <li><i class="icon-plane"></i> icon-plane</li>
                    <li><i class="icon-plus"></i> icon-plus</li>
                    <li><i class="icon-plus-sign"></i> icon-plus-sign</li>
                    <li><i class="icon-print"></i> icon-print</li>
                    <li><i class="icon-pushpin"></i> icon-pushpin</li>
                    <li><i class="icon-qrcode"></i> icon-qrcode</li>
                    <li><i class="icon-question-sign"></i> icon-question-sign</li>
                    <li><i class="icon-random"></i> icon-random</li>
                    <li><i class="icon-refresh"></i> icon-refresh</li>
                    <li><i class="icon-remove"></i> icon-remove</li>
                    <li><i class="icon-remove-circle"></i> icon-remove-circle</li>
                    <li><i class="icon-remove-sign"></i> icon-remove-sign</li>
                    <li><i class="icon-reorder"></i> icon-reorder</li>
                    <li><i class="icon-resize-horizontal"></i> icon-resize-horizontal</li>
                    <li><i class="icon-resize-vertical"></i> icon-resize-vertical</li>
                    <li><i class="icon-retweet"></i> icon-retweet</li>
                    <li><i class="icon-road"></i> icon-road</li>
                    <li><i class="icon-rss"></i> icon-rss</li>
                    <li><i class="icon-screenshot"></i> icon-screenshot</li>
                    <li><i class="icon-search"></i> icon-search</li>
                    <li><i class="icon-share"></i> icon-share</li>
                    <li><i class="icon-share-alt"></i> icon-share-alt</li>
                    <li><i class="icon-shopping-cart"></i> icon-shopping-cart</li>

                    <li><i class="icon-signal"></i> icon-signal</li>
                    <li><i class="icon-signin"></i> icon-signin</li>
                    <li><i class="icon-signout"></i> icon-signout</li>
                    <li><i class="icon-sitemap"></i> icon-sitemap</li>
                    <li><i class="icon-sort"></i> icon-sort</li>
                    <li><i class="icon-sort-down"></i> icon-sort-down</li>
                    <li><i class="icon-sort-up"></i> icon-sort-up</li>
                    <li><i class="icon-star"></i> icon-star</li>
                    <li><i class="icon-star-empty"></i> icon-star-empty</li>
                    <li><i class="icon-star-half"></i> icon-star-half</li>
                    <li><i class="icon-tag"></i> icon-tag</li>
                    <li><i class="icon-tags"></i> icon-tags</li>
                    <li><i class="icon-tasks"></i> icon-tasks</li>
                    <li><i class="icon-thumbs-down"></i> icon-thumbs-down</li>
                    <li><i class="icon-thumbs-up"></i> icon-thumbs-up</li>
                    <li><i class="icon-time"></i> icon-time</li>
                    <li><i class="icon-tint"></i> icon-tint</li>
                    <li><i class="icon-trash"></i> icon-trash</li>
                    <li><i class="icon-trophy"></i> icon-trophy</li>
                    <li><i class="icon-truck"></i> icon-truck</li>
                    <li><i class="icon-umbrella"></i> icon-umbrella</li>
                    <li><i class="icon-upload"></i> icon-upload</li>
                    <li><i class="icon-upload-alt"></i> icon-upload-alt</li>
                    <li><i class="icon-user"></i> icon-user</li>
                    <li><i class="icon-user-md"></i> icon-user-md</li>
                    <li><i class="icon-volume-off"></i> icon-volume-off</li>
                    <li><i class="icon-volume-down"></i> icon-volume-down</li>
                    <li><i class="icon-volume-up"></i> icon-volume-up</li>
                    <li><i class="icon-warning-sign"></i> icon-warning-sign</li>
                    <li><i class="icon-wrench"></i> icon-wrench</li>
                    <li><i class="icon-zoom-in"></i> icon-zoom-in</li>
                    <li><i class="icon-zoom-out"></i> icon-zoom-out</li>

                    <li><i class="icon-file"></i> icon-file</li>
                    <li><i class="icon-cut"></i> icon-cut</li>
                    <li><i class="icon-copy"></i> icon-copy</li>
                    <li><i class="icon-paste"></i> icon-paste</li>
                    <li><i class="icon-save"></i> icon-save</li>
                    <li><i class="icon-undo"></i> icon-undo</li>
                    <li><i class="icon-repeat"></i> icon-repeat</li>
                    <li><i class="icon-paper-clip"></i> icon-paper-clip</li>

                    <li><i class="icon-text-height"></i> icon-text-height</li>
                    <li><i class="icon-text-width"></i> icon-text-width</li>
                    <li><i class="icon-align-left"></i> icon-align-left</li>
                    <li><i class="icon-align-center"></i> icon-align-center</li>
                    <li><i class="icon-align-right"></i> icon-align-right</li>
                    <li><i class="icon-align-justify"></i> icon-align-justify</li>
                    <li><i class="icon-indent-left"></i> icon-indent-left</li>
                    <li><i class="icon-indent-right"></i> icon-indent-right</li>

                    <li><i class="icon-font"></i> icon-font</li>
                    <li><i class="icon-bold"></i> icon-bold</li>
                    <li><i class="icon-italic"></i> icon-italic</li>
                    <li><i class="icon-strikethrough"></i> icon-strikethrough</li>
                    <li><i class="icon-underline"></i> icon-underline</li>
                    <li><i class="icon-link"></i> icon-link</li>
                    <li><i class="icon-columns"></i> icon-columns</li>
                    <li><i class="icon-table"></i> icon-table</li>

                    <li><i class="icon-th-large"></i> icon-th-large</li>
                    <li><i class="icon-th"></i> icon-th</li>
                    <li><i class="icon-th-list"></i> icon-th-list</li>
                    <li><i class="icon-list"></i> icon-list</li>
                    <li><i class="icon-list-ol"></i> icon-list-ol</li>
                    <li><i class="icon-list-ul"></i> icon-list-ul</li>
                    <li><i class="icon-list-alt"></i> icon-list-alt</li>

                    <li><i class="icon-arrow-down"></i> icon-arrow-down</li>
                    <li><i class="icon-arrow-left"></i> icon-arrow-left</li>
                    <li><i class="icon-arrow-right"></i> icon-arrow-right</li>
                    <li><i class="icon-arrow-up"></i> icon-arrow-up</li>
                    <li><i class="icon-chevron-down"></i> icon-chevron-down</li>

                    <li><i class="icon-circle-arrow-down"></i> icon-circle-arrow-down</li>
                    <li><i class="icon-circle-arrow-left"></i> icon-circle-arrow-left</li>
                    <li><i class="icon-circle-arrow-right"></i> icon-circle-arrow-right</li>
                    <li><i class="icon-circle-arrow-up"></i> icon-circle-arrow-up</li>
                    <li><i class="icon-chevron-left"></i> icon-chevron-left</li>

                    <li><i class="icon-caret-down"></i> icon-caret-down</li>
                    <li><i class="icon-caret-left"></i> icon-caret-left</li>
                    <li><i class="icon-caret-right"></i> icon-caret-right</li>
                    <li><i class="icon-caret-up"></i> icon-caret-up</li>
                    <li><i class="icon-chevron-right"></i> icon-chevron-right</li>

                    <li><i class="icon-hand-down"></i> icon-hand-down</li>
                    <li><i class="icon-hand-left"></i> icon-hand-left</li>
                    <li><i class="icon-hand-right"></i> icon-hand-right</li>
                    <li><i class="icon-hand-up"></i> icon-hand-up</li>
                    <li><i class="icon-chevron-up"></i> icon-chevron-up</li>

                    <li><i class="icon-play-circle"></i> icon-play-circle</li>
                    <li><i class="icon-play"></i> icon-play</li>
                    <li><i class="icon-pause"></i> icon-pause</li>
                    <li><i class="icon-stop"></i> icon-stop</li>

                    <li><i class="icon-step-backward"></i> icon-step-backward</li>
                    <li><i class="icon-fast-backward"></i> icon-fast-backward</li>
                    <li><i class="icon-backward"></i> icon-backward</li>
                    <li><i class="icon-forward"></i> icon-forward</li>

                    <li><i class="icon-fast-forward"></i> icon-fast-forward</li>
                    <li><i class="icon-step-forward"></i> icon-step-forward</li>
                    <li><i class="icon-eject"></i> icon-eject</li>

                    <li><i class="icon-fullscreen"></i> icon-fullscreen</li>
                    <li><i class="icon-resize-full"></i> icon-resize-full</li>
                    <li><i class="icon-resize-small"></i> icon-resize-small</li>

                    <li><i class="icon-phone"></i> icon-phone</li>
                    <li><i class="icon-phone-sign"></i> icon-phone-sign</li>
                    <li><i class="icon-facebook"></i> icon-facebook</li>
                    <li><i class="icon-facebook-sign"></i> icon-facebook-sign</li>

                    <li><i class="icon-twitter"></i> icon-twitter</li>
                    <li><i class="icon-twitter-sign"></i> icon-twitter-sign</li>
                    <li><i class="icon-github"></i> icon-github</li>
                    <li><i class="icon-github-sign"></i> icon-github-sign</li>

                    <li><i class="icon-linkedin"></i> icon-linkedin</li>
                    <li><i class="icon-linkedin-sign"></i> icon-linkedin-sign</li>
                    <li><i class="icon-pinterest"></i> icon-pinterest</li>
                    <li><i class="icon-pinterest-sign"></i> icon-pinterest-sign</li>

                    <li><i class="icon-google-plus"></i> icon-google-plus</li>
                    <li><i class="icon-google-plus-sign"></i> icon-google-plus-sign</li>
                    <li><i class="icon-sign-blank"></i> icon-sign-blank</li>
                </ul>
            </div>
        </article>
    </div>
<?php get_footer(); ?>