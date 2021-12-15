<?php

namespace App\Models\Akun;

use CodeIgniter\Model;

class UserListModel extends Model
{
  protected $table      = 'users';
  protected $useTimestamps = true;
  protected $allowedFields = [
    'username',
    'email',
    'nik',
    'no_kk',
    'fullname',
    'tanggal_lahir',
    'no_hp',
    'nama_ibu',
    'user_image',
    'password_hash'
  ];

  public function getDetail($id)
  {
    $builder = $this->table('users');
    $builder->select('users.id as userid, username, email, nik, no_kk, fullname, tanggal_lahir, no_hp, nama_ibu, name, user_image');
    $builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
    $builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
    $builder->where('users.id', $id);
    $query = $builder->get()->getRow();

    return $query;
  }

  public function search($keyword)
  {
    $builder = $this->table('users');
    $builder->like('nik', $keyword);
    $builder->orLike('username', $keyword);
    $builder->orLike('email', $keyword);

    return $builder;
  }
}
