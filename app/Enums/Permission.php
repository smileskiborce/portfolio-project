<?php

namespace App\Enums;

enum Permission: string
{
    case CREATE_USER = 'Create user';
    case EDIT_USER = 'Edit user';
    case DELETE_USER = 'Delete user';
    case VIEW_USER = 'View user';
}
