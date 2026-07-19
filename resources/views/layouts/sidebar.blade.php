<aside class="sidebar bg-dark text-white">

<div class="p-3">

<h4 class="text-center">

QA/QC ERP

</h4>

<hr>

<ul class="nav flex-column">

<li class="nav-item">

<a href="{{ route('dashboard') }}" class="nav-link text-white">

<i class="bi bi-speedometer2"></i>

Dashboard

</a>

</li>

<li>

<a href="{{ route('global.search') }}"
class="{{ request()->routeIs('global.search') ? 'active' : '' }}">


<i class="bi bi-search"></i>

<span>
Global Search
</span>


</a>

</li>

<li class="nav-item">

<a href="{{ route('companies.index') }}" class="nav-link text-white">

<i class="bi bi-building"></i>

Companies

</a>

</li>

<li class="nav-item">

<a href="{{ route('products.index') }}" class="nav-link text-white">

<i class="bi bi-box"></i>

Products

</a>

</li>

<li class="nav-item">

<a href="{{ route('samples.index') }}" class="nav-link text-white">

<i class="bi bi-beaker"></i>

Samples

</a>

</li>

<li class="nav-item">

<a href="{{ route('sample-tests.index') }}" class="nav-link text-white">

<i class="bi bi-clipboard-data"></i>

Sample Tests

</a>

</li>

<li class="nav-item">

<a href="{{ route('qa.index') }}" class="nav-link text-white">

<i class="bi bi-check-circle"></i>

QA Approval

</a>

</li>

<li class="nav-item">

<a href="{{ route('users.index') }}" class="nav-link text-white">

<i class="bi bi-people"></i>

Users

</a>

</li>

</ul>

</div>

</aside>