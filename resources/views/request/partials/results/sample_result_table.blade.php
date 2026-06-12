


    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                
          
                    <div class="card-body table-responsive">
                        
                        <h4>Soil Analysis Result Sheet</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sample Ref</th>
                                    <th>Laboratory Number</th>
                                    <th>Lab User ID</th>
                                    <th>pH</th>
                                    <th>Colour</th>
                                    <th>Texture</th>
                                    <th>Percentage Sand</th>
                                    <th>Percentage Silt</th>
                                    <th>Percentage Clay</th>
                                    <th>Min Initial N</th>
                                    <th>P2O5 (ppm)</th>
                                    <th>Potassium (K)</th>
                                    <th>Magnesium (Mg)</th>
                                    <th>Calcium (Ca)</th>
                                    <th>Zinc (Zn)</th>
                                    <th>Copper (Cu)</th>
                                    <th>Manganese (Mn)</th>
                                    <th>Iron (Fe)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $farmer_sample_information->sample_reference ?? 'n/a' }}</td>
                                    <td>{{ $farmer_sample_information->laboratory_number  ?? 'n/a' }}</td>
                                    <td>{{ $farmer_sample_information->soilSampleResult->lab_user_id ?? 'n/a' }}</td>
                                    <td>{{ $farmer_sample_information->soilSampleResult->ph_cacl2 ?? 'n/a' }}</td>
                                    <td>{{ $farmer_sample_information->soilSampleResult->colour ?? 'n/a' }}</td>
                                    <td>{{ $farmer_sample_information->soilSampleResult->texture ?? 'n/a' }}</td>
                                    <td>{{ $farmer_sample_information->soilSampleResult->percentage_sand ?? 'n/a' }}</td>
                                    <td>{{ $farmer_sample_information->soilSampleResult->percentage_silt ?? 'n/a' }}</td>
                                    <td>{{ $farmer_sample_information->soilSampleResult->percentage_clay ?? 'n/a' }}</td>
                                    <td>{{ $farmer_sample_information->soilSampleResult->min_initial_n ?? 'n/a' }}</td>
                                    <td>{{ $farmer_sample_information->soilSampleResult->p2o5_ppm ?? 'n/a' }}</td>
                                    <td>{{ $farmer_sample_information->soilSampleResult->k ?? 'n/a' }}</td>
                                    <td>{{ $farmer_sample_information->soilSampleResult->mg ?? 'n/a' }}</td>
                                    <td>{{ $farmer_sample_information->soilSampleResult->ca ?? 'n/a' }}</td>
                                    <td>{{ $farmer_sample_information->soilSampleResult->zn ?? 'n/a' }}</td>
                                    <td>{{ $farmer_sample_information->soilSampleResult->cu ?? 'n/a' }}</td>
                                    <td>{{ $farmer_sample_information->soilSampleResult->mn ?? 'n/a' }}</td>
                                    <td>{{ $farmer_sample_information->soilSampleResult->fe ?? 'n/a' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
   
