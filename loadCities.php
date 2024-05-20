<script> 
<?php
    // Get Cities with their ids and convert them to JS array
        $sql = "SELECT DISTINCT city FROM `city` ORDER BY city";
        $all_cities = $conn->query($sql);
        $cities= array();
        if ($all_cities->num_rows > 0) {
        	while($city = $all_cities->fetch_assoc()) {
                $cities[]=$city;
        	}
        } else {
            console.log("No city records");
        }
        
        echo "const cities = [];";
		if($cities!="false"){
			for ($i=0;$i<count($cities);$i++) {
				//echo "cities[".$i."]=['".$cities[$i]["city"]."',".$cities[$i]["id"]."];";
				echo "cities.push('".$cities[$i]["city"]."');";
			}
		}
    ?>
    <?php
    // Get unique districts and convert them to JS array
        $sql = "SELECT DISTINCT district FROM `city` ORDER BY district";
        $all_districts = $conn->query($sql);
        $districts= array();
        if ($all_districts->num_rows > 0) {
        	while($district = $all_districts->fetch_assoc()) {
                $districts[]=$district;
        	}
        } else {
            console.log("No district records");
        }
        
        echo "const districts = [];";
		if($districts!="false"){
			for ($i=0;$i<count($districts);$i++) {
				//echo "districts[".$i."]=['".$districts[$i]["district"]."']";
				echo "districts.push('".$districts[$i]["district"]."');";
			}
		}
    ?>
    
       function listSuggestions(element, list) { 
            var input, filter, searchResults;
            input = document.getElementById(element);
            filter = input.value.toUpperCase();
            searchResults = document.getElementById(list);
            searchResults.innerHTML = ""; // Clear previous results
        
            if(element=='city')
                array = cities;
            else if (element=='district')
                array = districts; //console.log(array);
            // Filter districts based on user input
            searchResults.innerHTML = "<label for='close' id='closeSuggestions' style='float:right;' onclick='hideSuggestions();'>X</label>";
            array.forEach(function(item) {
                if (item.toUpperCase().startsWith(filter)) {
                    showSuggestions(list);
                    var result = document.createElement("div");
                    result.textContent = item;
                    result.addEventListener("click", function() {
                        //if(element=='city')
                         //   input.valueid = item[1];
                        input.value = item;
                        searchResults.innerHTML = ""; // Clear results after selection
                        //console.log(input.valueid);
                    });
                    searchResults.appendChild(result);
                }
            });
        }
        function hideSuggestions() { 
            //searchResults = document.getElementById(list);
            document.getElementById('lstCity').style ="display:none";
            document.getElementById('lstDistrict').style ="display:none";
        }
        function showSuggestions(list) { 
            //searchResults = document.getElementById(list);
            document.getElementById(list).style ="display:block";
            if(list=='lstDistrict')
                document.getElementById('lstCity').style ="display:none";
            if(list=='lstCity')
                document.getElementById('lstDistrict').style ="display:none";
        }
        function keyCode(event){
            var x = event.keyCode;
            if (x == 27) {
                hideSuggestions();
            }
        }
    </script>