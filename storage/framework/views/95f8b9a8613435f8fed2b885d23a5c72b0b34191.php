

<?php $__env->startSection('title'); ?>Base
 <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
	<?php $__env->startComponent('components.breadcrumb'); ?>
		<?php $__env->slot('breadcrumb_title'); ?>
			<h3>DATA Source DataTables</h3>
		<?php $__env->endSlot(); ?>
		<li class="breadcrumb-item">Tables</li>
		<li class="breadcrumb-item">Data Tables</li>
		<li class="breadcrumb-item active">Data Sources</li>
	<?php echo $__env->renderComponent(); ?>
	
	<div class="container-fluid">
	    <div class="row">
	        <!-- HTML (DOM) sourced data  Starts-->
	        <div class="col-sm-12">
	            <div class="card">
	                <div class="card-header">
	                    <h5>HTML (DOM) sourced data</h5>
	                    <span>
	                        The foundation for DataTables is progressive enhancement, so it is very adept at reading table information directly from the DOM. This example shows how easy it is to add searching, ordering and paging to your HTML
	                        table by simply running DataTables on it.
	                    </span>
	                </div>
	                <div class="card-body">
	                    <div class="table-responsive">
	                        <table class="display" id="data-source-1" style="width: 100%;">
	                            <thead>
	                                <tr>
	                                    <th>Name</th>
	                                    <th>Position</th>
	                                    <th>Office</th>
	                                    <th>Age</th>
	                                    <th>Start date</th>
	                                    <th>Salary</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                                <tr>
	                                    <td>Tiger Nixon</td>
	                                    <td>System Architect</td>
	                                    <td>Edinburgh</td>
	                                    <td>61</td>
	                                    <td>2011/04/25</td>
	                                    <td>$320,800</td>
	                                </tr>
	                                <tr>
	                                    <td>Garrett Winters</td>
	                                    <td>Accountant</td>
	                                    <td>Tokyo</td>
	                                    <td>63</td>
	                                    <td>2011/07/25</td>
	                                    <td>$170,750</td>
	                                </tr>
	                                <tr>
	                                    <td>Ashton Cox</td>
	                                    <td>Junior Technical Author</td>
	                                    <td>San Francisco</td>
	                                    <td>66</td>
	                                    <td>2009/01/12</td>
	                                    <td>$86,000</td>
	                                </tr>
	                                <tr>
	                                    <td>Cedric Kelly</td>
	                                    <td>Senior Javascript Developer</td>
	                                    <td>Edinburgh</td>
	                                    <td>22</td>
	                                    <td>2012/03/29</td>
	                                    <td>$433,060</td>
	                                </tr>
	                                <tr>
	                                    <td>Airi Satou</td>
	                                    <td>Accountant</td>
	                                    <td>Tokyo</td>
	                                    <td>33</td>
	                                    <td>2008/11/28</td>
	                                    <td>$162,700</td>
	                                </tr>
	                                <tr>
	                                    <td>Brielle Williamson</td>
	                                    <td>Integration Specialist</td>
	                                    <td>New York</td>
	                                    <td>61</td>
	                                    <td>2012/12/02</td>
	                                    <td>$372,000</td>
	                                </tr>
	                                <tr>
	                                    <td>Herrod Chandler</td>
	                                    <td>Sales Assistant</td>
	                                    <td>San Francisco</td>
	                                    <td>59</td>
	                                    <td>2012/08/06</td>
	                                    <td>$137,500</td>
	                                </tr>
	                                <tr>
	                                    <td>Rhona Davidson</td>
	                                    <td>Integration Specialist</td>
	                                    <td>Tokyo</td>
	                                    <td>55</td>
	                                    <td>2010/10/14</td>
	                                    <td>$327,900</td>
	                                </tr>
	                                <tr>
	                                    <td>Colleen Hurst</td>
	                                    <td>Javascript Developer</td>
	                                    <td>San Francisco</td>
	                                    <td>39</td>
	                                    <td>2009/09/15</td>
	                                    <td>$205,500</td>
	                                </tr>
	                                <tr>
	                                    <td>Sonya Frost</td>
	                                    <td>Software Engineer</td>
	                                    <td>Edinburgh</td>
	                                    <td>23</td>
	                                    <td>2008/12/13</td>
	                                    <td>$103,600</td>
	                                </tr>
	                                <tr>
	                                    <td>Jena Gaines</td>
	                                    <td>Office Manager</td>
	                                    <td>London</td>
	                                    <td>30</td>
	                                    <td>2008/12/19</td>
	                                    <td>$90,560</td>
	                                </tr>
	                                <tr>
	                                    <td>Quinn Flynn</td>
	                                    <td>Support Lead</td>
	                                    <td>Edinburgh</td>
	                                    <td>22</td>
	                                    <td>2013/03/03</td>
	                                    <td>$342,000</td>
	                                </tr>
	                                <tr>
	                                    <td>Charde Marshall</td>
	                                    <td>Regional Director</td>
	                                    <td>San Francisco</td>
	                                    <td>36</td>
	                                    <td>2008/10/16</td>
	                                    <td>$470,600</td>
	                                </tr>
	                                <tr>
	                                    <td>Haley Kennedy</td>
	                                    <td>Senior Marketing Designer</td>
	                                    <td>London</td>
	                                    <td>43</td>
	                                    <td>2012/12/18</td>
	                                    <td>$313,500</td>
	                                </tr>
	                                <tr>
	                                    <td>Tatyana Fitzpatrick</td>
	                                    <td>Regional Director</td>
	                                    <td>London</td>
	                                    <td>19</td>
	                                    <td>2010/03/17</td>
	                                    <td>$385,750</td>
	                                </tr>
	                                <tr>
	                                    <td>Michael Silva</td>
	                                    <td>Marketing Designer</td>
	                                    <td>London</td>
	                                    <td>66</td>
	                                    <td>2012/11/27</td>
	                                    <td>$198,500</td>
	                                </tr>
	                                <tr>
	                                    <td>Paul Byrd</td>
	                                    <td>Chief Financial Officer (CFO)</td>
	                                    <td>New York</td>
	                                    <td>64</td>
	                                    <td>2010/06/09</td>
	                                    <td>$725,000</td>
	                                </tr>
	                                <tr>
	                                    <td>Gloria Little</td>
	                                    <td>Systems Administrator</td>
	                                    <td>New York</td>
	                                    <td>59</td>
	                                    <td>2009/04/10</td>
	                                    <td>$237,500</td>
	                                </tr>
	                                <tr>
	                                    <td>Bradley Greer</td>
	                                    <td>Software Engineer</td>
	                                    <td>London</td>
	                                    <td>41</td>
	                                    <td>2012/10/13</td>
	                                    <td>$132,000</td>
	                                </tr>
	                                <tr>
	                                    <td>Dai Rios</td>
	                                    <td>Personnel Lead</td>
	                                    <td>Edinburgh</td>
	                                    <td>35</td>
	                                    <td>2012/09/26</td>
	                                    <td>$217,500</td>
	                                </tr>
	                                <tr>
	                                    <td>Jenette Caldwell</td>
	                                    <td>Development Lead</td>
	                                    <td>New York</td>
	                                    <td>30</td>
	                                    <td>2011/09/03</td>
	                                    <td>$345,000</td>
	                                </tr>
	                                <tr>
	                                    <td>Yuri Berry</td>
	                                    <td>Chief Marketing Officer (CMO)</td>
	                                    <td>New York</td>
	                                    <td>40</td>
	                                    <td>2009/06/25</td>
	                                    <td>$675,000</td>
	                                </tr>
	                                <tr>
	                                    <td>Caesar Vance</td>
	                                    <td>Pre-Sales Support</td>
	                                    <td>New York</td>
	                                    <td>21</td>
	                                    <td>2011/12/12</td>
	                                    <td>$106,450</td>
	                                </tr>
	                                <tr>
	                                    <td>Doris Wilder</td>
	                                    <td>Sales Assistant</td>
	                                    <td>Sidney</td>
	                                    <td>23</td>
	                                    <td>2010/09/20</td>
	                                    <td>$85,600</td>
	                                </tr>
	                                <tr>
	                                    <td>Angelica Ramos</td>
	                                    <td>Chief Executive Officer (CEO)</td>
	                                    <td>London</td>
	                                    <td>47</td>
	                                    <td>2009/10/09</td>
	                                    <td>$1,200,000</td>
	                                </tr>
	                                <tr>
	                                    <td>Gavin Joyce</td>
	                                    <td>Developer</td>
	                                    <td>Edinburgh</td>
	                                    <td>42</td>
	                                    <td>2010/12/22</td>
	                                    <td>$92,575</td>
	                                </tr>
	                                <tr>
	                                    <td>Jennifer Chang</td>
	                                    <td>Regional Director</td>
	                                    <td>Singapore</td>
	                                    <td>28</td>
	                                    <td>2010/11/14</td>
	                                    <td>$357,650</td>
	                                </tr>
	                                <tr>
	                                    <td>Brenden Wagner</td>
	                                    <td>Software Engineer</td>
	                                    <td>San Francisco</td>
	                                    <td>28</td>
	                                    <td>2011/06/07</td>
	                                    <td>$206,850</td>
	                                </tr>
	                                <tr>
	                                    <td>Fiona Green</td>
	                                    <td>Chief Operating Officer (COO)</td>
	                                    <td>San Francisco</td>
	                                    <td>48</td>
	                                    <td>2010/03/11</td>
	                                    <td>$850,000</td>
	                                </tr>
	                                <tr>
	                                    <td>Shou Itou</td>
	                                    <td>Regional Marketing</td>
	                                    <td>Tokyo</td>
	                                    <td>20</td>
	                                    <td>2011/08/14</td>
	                                    <td>$163,000</td>
	                                </tr>
	                                <tr>
	                                    <td>Michelle House</td>
	                                    <td>Integration Specialist</td>
	                                    <td>Sidney</td>
	                                    <td>37</td>
	                                    <td>2011/06/02</td>
	                                    <td>$95,400</td>
	                                </tr>
	                                <tr>
	                                    <td>Suki Burks</td>
	                                    <td>Developer</td>
	                                    <td>London</td>
	                                    <td>53</td>
	                                    <td>2009/10/22</td>
	                                    <td>$114,500</td>
	                                </tr>
	                                <tr>
	                                    <td>Prescott Bartlett</td>
	                                    <td>Technical Author</td>
	                                    <td>London</td>
	                                    <td>27</td>
	                                    <td>2011/05/07</td>
	                                    <td>$145,000</td>
	                                </tr>
	                                <tr>
	                                    <td>Gavin Cortez</td>
	                                    <td>Team Leader</td>
	                                    <td>San Francisco</td>
	                                    <td>22</td>
	                                    <td>2008/10/26</td>
	                                    <td>$235,500</td>
	                                </tr>
	                                <tr>
	                                    <td>Martena Mccray</td>
	                                    <td>Post-Sales support</td>
	                                    <td>Edinburgh</td>
	                                    <td>46</td>
	                                    <td>2011/03/09</td>
	                                    <td>$324,050</td>
	                                </tr>
	                                <tr>
	                                    <td>Unity Butler</td>
	                                    <td>Marketing Designer</td>
	                                    <td>San Francisco</td>
	                                    <td>47</td>
	                                    <td>2009/12/09</td>
	                                    <td>$85,675</td>
	                                </tr>
	                                <tr>
	                                    <td>Howard Hatfield</td>
	                                    <td>Office Manager</td>
	                                    <td>San Francisco</td>
	                                    <td>51</td>
	                                    <td>2008/12/16</td>
	                                    <td>$164,500</td>
	                                </tr>
	                                <tr>
	                                    <td>Hope Fuentes</td>
	                                    <td>Secretary</td>
	                                    <td>San Francisco</td>
	                                    <td>41</td>
	                                    <td>2010/02/12</td>
	                                    <td>$109,850</td>
	                                </tr>
	                                <tr>
	                                    <td>Vivian Harrell</td>
	                                    <td>Financial Controller</td>
	                                    <td>San Francisco</td>
	                                    <td>62</td>
	                                    <td>2009/02/14</td>
	                                    <td>$452,500</td>
	                                </tr>
	                                <tr>
	                                    <td>Timothy Mooney</td>
	                                    <td>Office Manager</td>
	                                    <td>London</td>
	                                    <td>37</td>
	                                    <td>2008/12/11</td>
	                                    <td>$136,200</td>
	                                </tr>
	                                <tr>
	                                    <td>Jackson Bradshaw</td>
	                                    <td>Director</td>
	                                    <td>New York</td>
	                                    <td>65</td>
	                                    <td>2008/09/26</td>
	                                    <td>$645,750</td>
	                                </tr>
	                                <tr>
	                                    <td>Olivia Liang</td>
	                                    <td>Support Engineer</td>
	                                    <td>Singapore</td>
	                                    <td>64</td>
	                                    <td>2011/02/03</td>
	                                    <td>$234,500</td>
	                                </tr>
	                                <tr>
	                                    <td>Bruno Nash</td>
	                                    <td>Software Engineer</td>
	                                    <td>London</td>
	                                    <td>38</td>
	                                    <td>2011/05/03</td>
	                                    <td>$163,500</td>
	                                </tr>
	                                <tr>
	                                    <td>Sakura Yamamoto</td>
	                                    <td>Support Engineer</td>
	                                    <td>Tokyo</td>
	                                    <td>37</td>
	                                    <td>2009/08/19</td>
	                                    <td>$139,575</td>
	                                </tr>
	                                <tr>
	                                    <td>Thor Walton</td>
	                                    <td>Developer</td>
	                                    <td>New York</td>
	                                    <td>61</td>
	                                    <td>2013/08/11</td>
	                                    <td>$98,540</td>
	                                </tr>
	                                <tr>
	                                    <td>Finn Camacho</td>
	                                    <td>Support Engineer</td>
	                                    <td>San Francisco</td>
	                                    <td>47</td>
	                                    <td>2009/07/07</td>
	                                    <td>$87,500</td>
	                                </tr>
	                                <tr>
	                                    <td>Serge Baldwin</td>
	                                    <td>Data Coordinator</td>
	                                    <td>Singapore</td>
	                                    <td>64</td>
	                                    <td>2012/04/09</td>
	                                    <td>$138,575</td>
	                                </tr>
	                                <tr>
	                                    <td>Zenaida Frank</td>
	                                    <td>Software Engineer</td>
	                                    <td>New York</td>
	                                    <td>63</td>
	                                    <td>2010/01/04</td>
	                                    <td>$125,250</td>
	                                </tr>
	                                <tr>
	                                    <td>Zorita Serrano</td>
	                                    <td>Software Engineer</td>
	                                    <td>San Francisco</td>
	                                    <td>56</td>
	                                    <td>2012/06/01</td>
	                                    <td>$115,000</td>
	                                </tr>
	                                <tr>
	                                    <td>Jennifer Acosta</td>
	                                    <td>Junior Javascript Developer</td>
	                                    <td>Edinburgh</td>
	                                    <td>43</td>
	                                    <td>2013/02/01</td>
	                                    <td>$75,650</td>
	                                </tr>
	                                <tr>
	                                    <td>Cara Stevens</td>
	                                    <td>Sales Assistant</td>
	                                    <td>New York</td>
	                                    <td>46</td>
	                                    <td>2011/12/06</td>
	                                    <td>$145,600</td>
	                                </tr>
	                                <tr>
	                                    <td>Hermione Butler</td>
	                                    <td>Regional Director</td>
	                                    <td>London</td>
	                                    <td>47</td>
	                                    <td>2011/03/21</td>
	                                    <td>$356,250</td>
	                                </tr>
	                                <tr>
	                                    <td>Lael Greer</td>
	                                    <td>Systems Administrator</td>
	                                    <td>London</td>
	                                    <td>21</td>
	                                    <td>2009/02/27</td>
	                                    <td>$103,500</td>
	                                </tr>
	                                <tr>
	                                    <td>Jonas Alexander</td>
	                                    <td>Developer</td>
	                                    <td>San Francisco</td>
	                                    <td>30</td>
	                                    <td>2010/07/14</td>
	                                    <td>$86,500</td>
	                                </tr>
	                                <tr>
	                                    <td>Shad Decker</td>
	                                    <td>Regional Director</td>
	                                    <td>Edinburgh</td>
	                                    <td>51</td>
	                                    <td>2008/11/13</td>
	                                    <td>$183,000</td>
	                                </tr>
	                                <tr>
	                                    <td>Michael Bruce</td>
	                                    <td>Javascript Developer</td>
	                                    <td>Singapore</td>
	                                    <td>29</td>
	                                    <td>2011/06/27</td>
	                                    <td>$183,000</td>
	                                </tr>
	                                <tr>
	                                    <td>Donna Snider</td>
	                                    <td>Customer Support</td>
	                                    <td>New York</td>
	                                    <td>27</td>
	                                    <td>2011/01/25</td>
	                                    <td>$112,000</td>
	                                </tr>
	                            </tbody>
	                            <tfoot>
	                                <tr>
	                                    <th>Name</th>
	                                    <th>Position</th>
	                                    <th>Office</th>
	                                    <th>Age</th>
	                                    <th>Start date</th>
	                                    <th>Salary</th>
	                                </tr>
	                            </tfoot>
	                        </table>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <!-- HTML (DOM) sourced data  Ends-->
	        <!-- Ajax sourced data  Starts-->
	        <div class="col-sm-12">
	            <div class="card">
	                <div class="card-header">
	                    <h5>Ajax sourced data</h5>
	                    <span>
	                        DataTables has the ability to read data from virtually any JSON data source that can be obtained by Ajax. This can be done, in its most simple form, by setting the <code>ajax:option</code> option to the address of
	                        the JSON data source.
	                    </span>
	                </div>
	                <div class="card-body">
	                    <div class="table-responsive">
	                        <table class="display" id="data-source-2" style="width: 100%;">
	                            <thead>
	                                <tr>
	                                    <th>Name</th>
	                                    <th>Position</th>
	                                    <th>Office</th>
	                                    <th>Extn.</th>
	                                    <th>Start date</th>
	                                    <th>Salary</th>
	                                </tr>
	                            </thead>
	                            <tfoot>
	                                <tr>
	                                    <th>Name</th>
	                                    <th>Position</th>
	                                    <th>Office</th>
	                                    <th>Extn.</th>
	                                    <th>Start date</th>
	                                    <th>Salary</th>
	                                </tr>
	                            </tfoot>
	                        </table>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <!-- Ajax sourced data Ends-->
	        <!-- Javascript sourced data  Starts-->
	        <div class="col-sm-12">
	            <div class="card">
	                <div class="card-header">
	                    <h5>Javascript sourced data</h5>
	                    <span>
	                        At times you will wish to be able to create a table from dynamic information passed directly to DataTables, rather than having it read from the document. This is achieved using the
	                        <code class="option" title="DataTables initialisation option">data</code> option in the initialisation object, passing in an array of data to be used (like all other DataTables handled data, this can be arrays or
	                        objects using the<code class="option" title="DataTables initialisation option">columns.data</code> option).
	                    </span>
	                    <span>
	                        A <code class="tag" title="HTML tag">table</code> must be available on the page for DataTables to use. This examples shows an empty <code class="tag" title="HTML tag">table</code> element being initialising as a
	                        DataTable with a set of data from a Javascript array. The columns in the table are dynamically created based on the <code class="option" title="DataTables initialisation option">columns.title</code> configuration
	                        option.
	                    </span>
	                </div>
	                <div class="card-body">
	                    <div class="table-responsive">
	                        <table class="display w-100" id="data-source-3"></table>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <!-- Javascript sourced data Ends-->
	        <!-- Server-side processing Starts-->
	        <div class="col-sm-12">
	            <div class="card">
	                <div class="card-header">
	                    <h5>Server-side processing</h5>
	                    <span>
	                        There are many ways to get your data into DataTables, and if you are working with seriously large databases, you might want to consider using the server-side options that DataTables provides. With server-side
	                        processing enabled, all paging, searching, ordering actions that DataTables performs are handed off to a server where an SQL engine (or similar) can perform these actions on the large data set (after all, that's what
	                        the database engine is designed for!). As such, each draw of the table will result in a new Ajax request being made to get the required data.
	                    </span>
	                    <span>
	                        Server-side processing is enabled by setting the <code class="option" title="DataTables initialisation option">serverSide:option</code> option to <code>true</code> and providing an Ajax data source through the
	                        <code class="option" title="DataTables initialisation option">ajax:option</code> option.
	                    </span>
	                </div>
	                <div class="card-body">
	                    <div class="table-responsive">
	                        <table class="display" id="data-source-4" style="width: 100%;">
	                            <thead>
	                                <tr>
	                                    <th>First name</th>
	                                    <th>Last name</th>
	                                    <th>Position</th>
	                                    <th>Office</th>
	                                    <th>Start date</th>
	                                    <th>Salary</th>
	                                </tr>
	                            </thead>
	                            <tfoot>
	                                <tr>
	                                    <th>First name</th>
	                                    <th>Last name</th>
	                                    <th>Position</th>
	                                    <th>Office</th>
	                                    <th>Start date</th>
	                                    <th>Salary</th>
	                                </tr>
	                            </tfoot>
	                        </table>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

	
	<?php $__env->startPush('scripts'); ?>
	<script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatables/datatable.custom.js')); ?>"></script>
	<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hibah\PFE\plateformeEls\resources\views\admin\tables\data-tables\datatable-data-source.blade.php ENDPATH**/ ?>