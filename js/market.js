var Market=
{
	job:function()
	{
		Site.api('market/job/offers',{country:User.info.country},function(data)
		{
			html=Site.parseTemplate(function()
			{/*
			
				<h1>
					<span></span>Job Market
				</h1>
				<br>

				<div style="width:250px;" class="testDivblue ">
				<b>Selection criteria:</b><br>	

				<form id="jobMarketForm" action="jobMarket.html" method="GET"> 
					Country:
				<select id="countryId" name="countryId" >
						<option value="24">Argentina</option>			
				</select>
					<br>
				Economic skill:
				<select id="minimalSkill" name="minimalSkill" >
					
					<option value="1" selected="selected">1</option>
				
					<option value="2">2</option>
				
					<option value="3">3</option>
				
					<option value="4">4</option>
				
					<option value="5">5</option>
				
					<option value="6">6</option>
				
					<option value="7">7</option>
				
					<option value="8">8</option>
				
					<option value="9">9</option>
				
					<option value="10">10</option>
				
					<option value="11">11</option>
				
					<option value="12">12</option>
				
					<option value="13">13</option>
				
					<option value="14">14</option>
				
					<option value="15">15</option>
				
					<option value="16">16</option>
				
					<option value="17">17</option>
				
					<option value="18">18</option>
				
					<option value="19">19</option>
				
					<option value="20">20</option>
				
			</select>
		
			<input type="submit" value="Show">
			
		</form>
		<p style="clear: both"></p> </div>

		<br>
			<hr class="littleDashedLine">	
			
			<table style="width: 100%;margin-left: auto; margin-right: auto;" class="dataTable">
				<tbody>
					<tr>
						<td>Employer</td>
						<td>Company</td>
						<td>Product</td>
						<td>Minimal skill</td>
						<td>Salary</td>
						<td id="jobMarketOffersTable">Apply</td>
					</tr>
					
					<% for(k in offers){ var offer=offers[k]; %>
					<tr>
						<td>
							<a href="profile.html?id=<%=offer.company.id%>"><%=offer.owner.name%></a> <div class="flags-small <%=offer.country.name%>"></div><br>
							<img style="width:40px; height:40px; border:1px solid #888;" src="http://primera.e-sim.net:3000/avatars/255757_small">
						</td>
						<td>
							<a href="company.html?id=<%=offer.company.id%>" style="font-weight: bold"><%=offer.company.name%></a>
						</td>
						<td>
							<div class="product">
								<div>
									<img src="http://e-sim.home.pl/testura/img/productIcons/<%=offer.product.name%>.png" title="">
									<img src="http://e-sim.home.pl/testura/img/productIcons/q<%=offer.product.quality%>.png" title="">
								</div>
							</div>
						</td>
						<td> <%=offer.skill%> </td>
						<td>
							<div class="flags-small <%=offer.country.name%>"></div> <b><%=offer.salary%></b> <%=offer.country.currency%>
						</td>
						<td>
							<form action="jobMarket.html" method="POST">
								<input type="hidden" name="id" value="<%=offer.id%>">
								<input type="submit" value="Apply">
							</form>
						</td>
					</tr>
					<%}%>
				</tbody>
			</table>
		<br>
			<div style="text-align: center"></div>
			*/},{offers:data});
		Site.html({html:html,title:"Job Market"});
		
		});
	}
}