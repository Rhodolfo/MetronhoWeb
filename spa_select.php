<div ng-controller="otherCtrl">
	Número = {{numb}}
	<br>
	<select ng-model="numb" ng-options="row.id as row.str for row in opts"></select>
</div>
