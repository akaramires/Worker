<?php

    use Illuminate\Auth\UserTrait;
    use Illuminate\Auth\UserInterface;
    use Illuminate\Auth\Reminders\RemindableTrait;
    use Illuminate\Auth\Reminders\RemindableInterface;
    use Illuminate\Database\Eloquent\SoftDeletingTrait;

    /**
     * User
     *
     * @property integer                                               $id
     * @property integer                                               $wp_id
     * @property string                                                $username
     * @property string                                                $email
     * @property string                                                $password
     * @property string                                                $first_name
     * @property string                                                $last_name
     * @property boolean                                               $active
     * @property integer                                               $role_id
     * @property string                                                $remember_token
     * @property string                                                $deleted_at
     * @property \Carbon\Carbon                                        $created_at
     * @property \Carbon\Carbon                                        $updated_at
     * @property-read \Role                                            $role
     * @property-read \Illuminate\Database\Eloquent\Collection|\Hour[] $hours
     * @method static \Illuminate\Database\Query\Builder|\User whereId($value)
     * @method static \Illuminate\Database\Query\Builder|\User whereWpId($value)
     * @method static \Illuminate\Database\Query\Builder|\User whereUsername($value)
     * @method static \Illuminate\Database\Query\Builder|\User whereEmail($value)
     * @method static \Illuminate\Database\Query\Builder|\User wherePassword($value)
     * @method static \Illuminate\Database\Query\Builder|\User whereFirstName($value)
     * @method static \Illuminate\Database\Query\Builder|\User whereLastName($value)
     * @method static \Illuminate\Database\Query\Builder|\User whereActive($value)
     * @method static \Illuminate\Database\Query\Builder|\User whereRoleId($value)
     * @method static \Illuminate\Database\Query\Builder|\User whereRememberToken($value)
     * @method static \Illuminate\Database\Query\Builder|\User whereDeletedAt($value)
     * @method static \Illuminate\Database\Query\Builder|\User whereCreatedAt($value)
     * @method static \Illuminate\Database\Query\Builder|\User whereUpdatedAt($value)
     */
    class User extends Eloquent implements UserInterface, RemindableInterface
    {
        use UserTrait, RemindableTrait, SoftDeletingTrait;

        protected $table = 'users';

        protected $hidden = array('password', 'remember_token');

        public static $rules = array(
            'first_name'            => 'required|alpha|min:3',
            'last_name'             => 'required|alpha|min:1',
            'username'              => 'required|unique:users',
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|alpha_num|between:6,12|confirmed',
            'password_confirmation' => 'required|alpha_num|between:6,12'
        );

        public function role ()
        {
            return $this->belongsTo('Role', 'role_id');
        }

        public function hours ()
        {
            return $this->hasMany('Hour');
        }

        public function redirectToOwnPage ()
        {
            switch ($this->role->slug) {
                case 'developer':
                    $url = '/hours';
                    break;
                case 'manager':
                    $url = '/reports';
                    break;
                case 'admin':
                    $url = '/admin';
                    break;
                default:
                    $url = 'login';
                    break;
            }

            return Redirect::to($url);
        }
    }