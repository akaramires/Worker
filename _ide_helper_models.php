<?php
/**
 * An helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace {
/**
 * Class Permission
 *
 * @property int                                                 $id
 * @property string                                              $slug
 * @property string                                              $name
 * @property string                                              $description
 * @property string                                              $deleted_at
 * @property string                                              $created_at
 * @property string                                              $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\User[]    $users
 */
	class Permission {}
}

namespace {
/**
 * User
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\Hour[] $hours
 */
	class User {}
}

namespace {
/**
 * Class Hour
 *
 * @property int      $id
 * @property string   $description
 * @property int      $count
 * @property string   $date
 * @property string   $deleted_at
 * @property string   $created_at
 * @property string   $updated_at
 * @property-read \User    $user
 * @property-read \Project $project
 */
	class Hour {}
}

namespace {
/**
 * Class Project
 *
 * @property int                                              $id
 * @property int                                              $parent_id
 * @property string                                           $title
 * @property string                                           $slug
 * @property string                                           $deleted_at
 * @property string                                           $created_at
 * @property string                                           $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Hour[] $hours
 */
	class Project {}
}

