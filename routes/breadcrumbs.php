<?php
Breadcrumbs::for('home', function ($trail) {
  $trail->push('Home', route('home'));
});


Breadcrumbs::for('customers', function ($trail) {
  $trail->parent('home');
  $trail->push('Customers', route('customers.index'));
});

Breadcrumbs::for('visits', function ($trail, $customer) {
    $trail->parent('customers');
    $trail->push('Visits', route('visits.visitsByCustomer', $customer));
});

Breadcrumbs::for('details', function ($trail, $customer, $visit) {
  $trail->parent('visits', $customer);
  $trail->push('Project details', route('visits.details', $visit));
});

Breadcrumbs::for('services', function ($trail, $customer, $visit) {
  $trail->parent('details', $customer, $visit);
  $trail->push('Quotes', route('services.servicesByVisit', ['visit' => $visit, 'customer' => $customer]));
});

Breadcrumbs::for('change', function ($trail, $customer, $visit) {
  $trail->parent('details', $customer, $visit);
  $trail->push('Change Orders', route('services.servicesByVisit', ['visit' => $visit, 'customer' => $customer]));
});

