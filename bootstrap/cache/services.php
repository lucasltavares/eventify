<?php return array (
  'providers' => 
  array (
    0 => 'Inertia\\ServiceProvider',
    1 => 'Laravel\\Tinker\\TinkerServiceProvider',
    2 => 'Carbon\\Laravel\\ServiceProvider',
    3 => 'Termwind\\Laravel\\TermwindServiceProvider',
    4 => 'Tighten\\Ziggy\\ZiggyServiceProvider',
    5 => 'App\\Providers\\AppServiceProvider',
  ),
  'eager' => 
  array (
    0 => 'Inertia\\ServiceProvider',
    1 => 'Carbon\\Laravel\\ServiceProvider',
    2 => 'Termwind\\Laravel\\TermwindServiceProvider',
    3 => 'Tighten\\Ziggy\\ZiggyServiceProvider',
    4 => 'App\\Providers\\AppServiceProvider',
  ),
  'deferred' => 
  array (
    'command.tinker' => 'Laravel\\Tinker\\TinkerServiceProvider',
  ),
  'when' => 
  array (
    'Laravel\\Tinker\\TinkerServiceProvider' => 
    array (
    ),
  ),
);