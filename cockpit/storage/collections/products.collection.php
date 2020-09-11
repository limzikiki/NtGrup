<?php
 return array (
  'name' => 'products',
  'label' => 'Products',
  '_id' => 'products5efcfbe1a7582',
  'fields' => 
  array (
    0 => 
    array (
      'name' => 'title',
      'label' => '',
      'type' => 'text',
      'default' => '',
      'info' => '',
      'group' => '',
      'localize' => true,
      'options' => 
      array (
      ),
      'width' => '1-1',
      'lst' => true,
      'acl' => 
      array (
      ),
      'required' => true,
    ),
    1 => 
    array (
      'name' => 'content',
      'label' => '',
      'type' => 'wysiwyg',
      'default' => '',
      'info' => '',
      'group' => '',
      'localize' => true,
      'options' => 
      array (
      ),
      'width' => '1-1',
      'lst' => true,
      'acl' => 
      array (
      ),
      'required' => true,
    ),
    2 => 
    array (
      'name' => 'gallery',
      'label' => 'Галлерея',
      'type' => 'gallery',
      'default' => '',
      'info' => '',
      'group' => '',
      'localize' => false,
      'options' => 
      array (
      ),
      'width' => '1-1',
      'lst' => true,
      'acl' => 
      array (
      ),
    ),
  ),
  'sortable' => true,
  'in_menu' => false,
  '_created' => 1593637857,
  '_modified' => 1599845736,
  'color' => '#5D9CEC',
  'acl' => 
  array (
    'general' => 
    array (
      'collection_edit' => false,
      'entries_delete' => true,
      'entries_edit' => true,
      'entries_view' => true,
      'entries_create' => true,
    ),
  ),
  'sort' => 
  array (
    'column' => '_modified',
    'dir' => 1,
  ),
  'rules' => 
  array (
    'create' => 
    array (
      'enabled' => false,
    ),
    'read' => 
    array (
      'enabled' => false,
    ),
    'update' => 
    array (
      'enabled' => false,
    ),
    'delete' => 
    array (
      'enabled' => false,
    ),
  ),
  'icon' => 'business.svg',
);