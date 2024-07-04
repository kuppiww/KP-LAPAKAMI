<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Auth;
use App\Models\Condition;

class HTMLHelper
{

    public static function renderConditionBadges($condition_id, $condition_color, $condition_name)
    {
        if (!empty($condition_id)){
            $html = '<span class="badge badge-'. $condition_color .'">'. $condition_name .'</span>';
        }else{
            $html ='-';
        }

        return $html;
    }

    public static function renderConditionAttendanceBadges($attendance_score)
    {
        $condition = Condition::where('condition_min_value', '<=', $attendance_score)->where('condition_max_value', '>=', $attendance_score)->first();

        if($condition){
            $html = '<span class="badge badge-'.$condition->condition_color.'">'.$condition->condition_name.'</span>';
        } else{
            $html ='-';
        }

        return $html;
    }

    public static function renderStatusBadges($_status)
    {                
        if ($_status == 0){
            $html = '<span class="badge badge-warning">Diajukan </span>';
        }elseif($_status == 1){
            $html = '<span class="badge badge-success">Aktif/Disetujui </span>';
        }elseif($_status == 2){
            $html ='<span class="badge badge-danger">Ditolak </span>';
        }else{
            $html ='<span class="badge badge-danger">Non Aktif </span>';
        }

        return $html;
    }

    public static function renderEditLink($id)
    {
        return '<a href="#" onclick="showEditModal(' . $id . ')" class="btn-sm btn-primary">Ubah</a>';
    }

    public static function renderDeleteLink($id)
    {
        return '<a href="#" onclick="showDeleteModal(' . $id . ')" class="btn btn-danger">Hapus</a>';
    }

    public static function renderEditDeleteLink($id)
    {
        return '<a href="#" onclick="showEditModal(' . $id . ')" class="btn-sm btn-primary">Ubah</a>' .
            '&nbsp;' .
            '<a href="#" onclick="showDeleteModal(' . $id . ')" class="btn-sm btn-danger">Hapus</a>';
    }

    public static function renderEditDeleteLinkDisabled($id)
    {
        return '<a href="#" class="btn-sm btn-primary" disabled="disabled">Ubah</a>' .
            '&nbsp;' .
            '<a href="#" class="btn-sm btn-danger" disabled="disabled">Hapus</a>';
    }

    public static function renderActionStudent($student_nisn, $student_status)
    {   
        $group  = Auth::user()->group_id;

        if ($student_status == 0){
            if ($group < 7){
            $html = '<a href="javascript:void(0)" class="btn btn-sm btn-outline-success btnStats" data-url="'. url('student/status/'. $student_nisn).'/1" data-toggle="tooltip" data-placement="top" title="Setujui">
            <i class="fas fa-check"></i>
            </a>        
            <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger btnStats" data-url="'. url('student/status/'. $student_nisn).'/2" data-toggle="tooltip" data-placement="top" title="Tolak">
            <i class="fas fa-minus-circle"></i>
            </a> 
            <a href="javascript:void(0)" class="btn btn-sm btn-outline-default btnEdit" data-id="'.$student_nisn .'" data-toggle="tooltip" data-placement="top" title data-original-title="Ubah">
                <i class="fas fa-pencil-alt"></i>
            </a>
            <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger btnDelete" data-url="'.url('student/delete/'. $student_nisn) .'" data-toggle="tooltip" data-placement="top" title data-original-title="Hapus">
            <i class="fas fa-trash-alt"></i>
            </a>';}
            else{
                $html = '<a href="javascript:void(0)" class="btn btn-sm btn-outline-default btnEdit" data-id="'.$student_nisn .'" data-toggle="tooltip" data-placement="top" title data-original-title="Ubah">
                <i class="fas fa-pencil-alt"></i>
                </a>
                <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger btnDelete" data-url="'.url('student/delete/'. $student_nisn) .'" data-toggle="tooltip" data-placement="top" title data-original-title="Hapus">
                <i class="fas fa-trash-alt"></i>
                </a>';
            }
        } elseif ($student_status == 1 ){
            if ($group < 7){
                $html = '<a href="javascript:void(0)" class="btn btn-sm btn-outline-success btn-outline-danger btnStats" data-url="'. url('student/status/'. $student_nisn).'/3" data-toggle="tooltip" data-placement="top" title="Non Aktif">
                <i class="fas fa-minus-circle"></i>
                </a>            
                <a href="javascript:void(0)" class="btn btn-sm btn-outline-warning btnReset" data-url="'. url('student/reset/'. $student_nisn).'" data-toggle="tooltip" data-placement="top" title data-original-title="Atur Ulang Kata Sandi">
                <i class="fas fa-key"></i>
                </a>
                <a href="javascript:void(0)" class="btn btn-sm btn-outline-default btnEdit" data-id="'.$student_nisn .'" data-toggle="tooltip" data-placement="top" title data-original-title="Ubah">
                    <i class="fas fa-pencil-alt"></i>
                </a>
                <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger btnDelete" data-url="'.url('student/delete/'. $student_nisn) .'" data-toggle="tooltip" data-placement="top" title data-original-title="Hapus">
                <i class="fas fa-trash-alt"></i>
                </a>';
            }else{
                $html = '<a href="javascript:void(0)" class="btn btn-sm btn-outline-success btn-outline-danger btnStats" data-url="'. url('student/status/'. $student_nisn).'/3" data-toggle="tooltip" data-placement="top" title="Non Aktif">
                <i class="fas fa-minus-circle"></i>
                </a>            
                <a href="javascript:void(0)" class="btn btn-sm btn-outline-warning btnReset" data-url="'. url('student/reset/'. $student_nisn).'" data-toggle="tooltip" data-placement="top" title data-original-title="Atur Ulang Kata Sandi">
                <i class="fas fa-key"></i>
                </a>
                <a href="javascript:void(0)" class="btn btn-sm btn-outline-default btnEdit" data-id="'.$student_nisn .'" data-toggle="tooltip" data-placement="top" title data-original-title="Ubah">
                    <i class="fas fa-pencil-alt"></i>
                </a>';
            }
        }elseif ($student_status == 3 ){
            if ($group < 7){
                $html = '<a href="javascript:void(0)" class="btn btn-sm btn-outline-success btnStats" data-url="'. url('student/status/'. $student_nisn).'/1" data-toggle="tooltip" data-placement="top" title="Aktifkan">
                    <i class="fas fa-check"></i>
                </a>
                <a href="javascript:void(0)" class="btn btn-sm btn-outline-warning btnReset" data-url="'. url('student/reset/'. $student_nisn).'" data-toggle="tooltip" data-placement="top" title data-original-title="Atur Ulang Kata Sandi">
                <i class="fas fa-key"></i>
                </a>
                <a href="javascript:void(0)" class="btn btn-sm btn-outline-default btnEdit" data-id="'.$student_nisn .'" data-toggle="tooltip" data-placement="top" title data-original-title="Ubah">
                    <i class="fas fa-pencil-alt"></i>
                </a>
                <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger btnDelete" data-url="'.url('student/delete/'. $student_nisn) .'" data-toggle="tooltip" data-placement="top" title data-original-title="Hapus">
                <i class="fas fa-trash-alt"></i>
                </a>';
            }else{
                $html = '<a href="javascript:void(0)" class="btn btn-sm btn-outline-default btnEdit" data-id="'.$student_nisn .'" data-toggle="tooltip" data-placement="top" title data-original-title="Ubah">
                <i class="fas fa-pencil-alt"></i>
            </a>';
            }
        }else{
            if ($group < 7){
                $html = '<a href="javascript:void(0)" class="btn btn-sm btn-outline-success btnStats" data-url="'. url('student/status/'. $student_nisn).'/1" data-toggle="tooltip" data-placement="top" title="Setujui"><i class="fas fa-check"></i></a>
                <a href="javascript:void(0)" class="btn btn-sm btn-outline-warning btnReset" data-url="'. url('student/reset/'. $student_nisn).'" data-toggle="tooltip" data-placement="top" title data-original-title="Atur Ulang Kata Sandi">
                <i class="fas fa-key"></i>
                </a>
                <a href="javascript:void(0)" class="btn btn-sm btn-outline-default btnEdit" data-id="'.$student_nisn .'" data-toggle="tooltip" data-placement="top" title data-original-title="Ubah">
                    <i class="fas fa-pencil-alt"></i>
                </a>
                <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger btnDelete" data-url="'.url('student/delete/'. $student_nisn) .'" data-toggle="tooltip" data-placement="top" title data-original-title="Hapus">
                <i class="fas fa-trash-alt"></i>
                </a>';
            }else{
                $html = '<a href="javascript:void(0)" class="btn btn-sm btn-outline-default btnEdit" data-id="'.$student_nisn .'" data-toggle="tooltip" data-placement="top" title data-original-title="Ubah">
                <i class="fas fa-pencil-alt"></i>
            </a>';
            }
        }       
        
        return $html;
    }

    public static function renderActionAtendance($attendance_id)
    {   
        $html = '<a href="javascript:void(0)" class="btn btn-sm btn-outline-default btnShow" data-id="'.$attendance_id.'" data-toggle="tooltip" data-placement="top" title="Lihat">
                <i class="fas fa-eye"></i>
                </a>
                <a href="'. url('attendanceteacher/edit/'. $attendance_id).'" class="btn btn-sm btn-outline-default" data-toggle="tooltip" data-placement="top" title="Ubah">
                    <i class="fas fa-pencil-alt"></i>
                </a>
                <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger btnDelete" data-url="'. url('attendanceteacher/delete/'. $attendance_id).'" data-toggle="tooltip" data-placement="top" title="Hapus">
                    <i class="fas fa-trash-alt"></i>
                </a>';
        return $html;
    }

    public static function renderActionAtendanceStudent($attendance_id)
    {   
        $html = '<a href="javascript:void(0)" class="btn btn-sm btn-outline-default btnShow" data-id="'.$attendance_id.'" data-toggle="tooltip" data-placement="top" title="Lihat">
                <i class="fas fa-eye"></i>
                </a>
                <a href="'. url('attendancestudent/edit/'. $attendance_id).'" class="btn btn-sm btn-outline-default" data-toggle="tooltip" data-placement="top" title="Ubah">
                    <i class="fas fa-pencil-alt"></i>
                </a>
                <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger btnDelete" data-url="'. url('attendancestudent/delete/'. $attendance_id).'" data-toggle="tooltip" data-placement="top" title="Hapus">
                    <i class="fas fa-trash-alt"></i>
                </a>';
        return $html;
    }

    public static function renderActionTeacher($teacher_nik, $teacher_status)
    {   
        $group  = Auth::user()->group_id;

        if ($teacher_status == 0){
            if ($group < 7){
            $html = '<a href="javascript:void(0)" class="btn btn-sm btn-outline-success btnStats" data-url="'. url('teacher/status/'. $teacher_nik).'/1" data-toggle="tooltip" data-placement="top" title="Setujui">
            <i class="fas fa-check"></i>
            </a>        
            <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger btnStats" data-url="'. url('teacher/status/'. $teacher_nik).'/2" data-toggle="tooltip" data-placement="top" title="Tolak">
            <i class="fas fa-minus-circle"></i>
            </a> 
            <a href="javascript:void(0)" class="btn btn-sm btn-outline-default btnEdit" data-id="'.$teacher_nik .'" data-toggle="tooltip" data-placement="top" title data-original-title="Ubah">
                <i class="fas fa-pencil-alt"></i>
            </a>
            <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger btnDelete" data-url="'.url('teacher/delete/'. $teacher_nik) .'" data-toggle="tooltip" data-placement="top" title data-original-title="Hapus">
            <i class="fas fa-trash-alt"></i>
            </a>';}
            else{
                $html = '<a href="javascript:void(0)" class="btn btn-sm btn-outline-default btnEdit" data-id="'.$teacher_nik .'" data-toggle="tooltip" data-placement="top" title data-original-title="Ubah">
                <i class="fas fa-pencil-alt"></i>
                </a>
                <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger btnDelete" data-url="'.url('teacher/delete/'. $teacher_nik) .'" data-toggle="tooltip" data-placement="top" title data-original-title="Hapus">
                <i class="fas fa-trash-alt"></i>
                </a>';
            }
        } elseif ($teacher_status == 1 ){
            if ($group < 7){
                $html = '<a href="javascript:void(0)" class="btn btn-sm btn-outline-success btn-outline-danger btnStats" data-url="'. url('teacher/status/'. $teacher_nik).'/3" data-toggle="tooltip" data-placement="top" title="Non Aktif">
                <i class="fas fa-minus-circle"></i>
                </a>            
                <a href="javascript:void(0)" class="btn btn-sm btn-outline-warning btnReset" data-url="'. url('teacher/reset/'. $teacher_nik).'" data-toggle="tooltip" data-placement="top" title data-original-title="Atur Ulang Kata Sandi">
                <i class="fas fa-key"></i>
                </a>
                <a href="javascript:void(0)" class="btn btn-sm btn-outline-default btnEdit" data-id="'.$teacher_nik .'" data-toggle="tooltip" data-placement="top" title data-original-title="Ubah">
                    <i class="fas fa-pencil-alt"></i>
                </a>
                <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger btnDelete" data-url="'.url('teacher/delete/'. $teacher_nik) .'" data-toggle="tooltip" data-placement="top" title data-original-title="Hapus">
                <i class="fas fa-trash-alt"></i>
                </a>';
            }else{
                $html = '<a href="javascript:void(0)" class="btn btn-sm btn-outline-success btn-outline-danger btnStats" data-url="'. url('teacher/status/'. $teacher_nik).'/3" data-toggle="tooltip" data-placement="top" title="Non Aktif">
                <i class="fas fa-minus-circle"></i>
                </a>            
                <a href="javascript:void(0)" class="btn btn-sm btn-outline-warning btnReset" data-url="'. url('teacher/reset/'. $teacher_nik).'" data-toggle="tooltip" data-placement="top" title data-original-title="Atur Ulang Kata Sandi">
                <i class="fas fa-key"></i>
                </a>
                <a href="javascript:void(0)" class="btn btn-sm btn-outline-default btnEdit" data-id="'.$teacher_nik .'" data-toggle="tooltip" data-placement="top" title data-original-title="Ubah">
                    <i class="fas fa-pencil-alt"></i>
                </a>';
            }
        }elseif ($teacher_status == 3 ){
            if ($group < 7){
                $html = '<a href="javascript:void(0)" class="btn btn-sm btn-outline-success btnStats" data-url="'. url('teacher/status/'. $teacher_nik).'/1" data-toggle="tooltip" data-placement="top" title="Aktifkan">
                    <i class="fas fa-check"></i>
                </a>
                <a href="javascript:void(0)" class="btn btn-sm btn-outline-warning btnReset" data-url="'. url('teacher/reset/'. $teacher_nik).'" data-toggle="tooltip" data-placement="top" title data-original-title="Atur Ulang Kata Sandi">
                <i class="fas fa-key"></i>
                </a>
                <a href="javascript:void(0)" class="btn btn-sm btn-outline-default btnEdit" data-id="'.$teacher_nik .'" data-toggle="tooltip" data-placement="top" title data-original-title="Ubah">
                    <i class="fas fa-pencil-alt"></i>
                </a>
                <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger btnDelete" data-url="'.url('teacher/delete/'. $teacher_nik) .'" data-toggle="tooltip" data-placement="top" title data-original-title="Hapus">
                <i class="fas fa-trash-alt"></i>
                </a>';
            }else{
                $html = '<a href="javascript:void(0)" class="btn btn-sm btn-outline-default btnEdit" data-id="'.$teacher_nik .'" data-toggle="tooltip" data-placement="top" title data-original-title="Ubah">
                <i class="fas fa-pencil-alt"></i>
            </a>';
            }
        }else{
            if ($group < 7){
                $html = '<a href="javascript:void(0)" class="btn btn-sm btn-outline-success btnStats" data-url="'. url('teacher/status/'. $teacher_nik).'/1" data-toggle="tooltip" data-placement="top" title="Setujui"><i class="fas fa-check"></i></a>
                <a href="javascript:void(0)" class="btn btn-sm btn-outline-warning btnReset" data-url="'. url('teacher/reset/'. $teacher_nik).'" data-toggle="tooltip" data-placement="top" title data-original-title="Atur Ulang Kata Sandi">
                <i class="fas fa-key"></i>
                </a>
                <a href="javascript:void(0)" class="btn btn-sm btn-outline-default btnEdit" data-id="'.$teacher_nik .'" data-toggle="tooltip" data-placement="top" title data-original-title="Ubah">
                    <i class="fas fa-pencil-alt"></i>
                </a>
                <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger btnDelete" data-url="'.url('teacher/delete/'. $teacher_nik) .'" data-toggle="tooltip" data-placement="top" title data-original-title="Hapus">
                <i class="fas fa-trash-alt"></i>
                </a>';
            }else{
                $html = '<a href="javascript:void(0)" class="btn btn-sm btn-outline-default btnEdit" data-id="'.$teacher_nik .'" data-toggle="tooltip" data-placement="top" title data-original-title="Ubah">
                <i class="fas fa-pencil-alt"></i>
            </a>';
            }
        }       
        
        
        return $html;


        $group  = Auth::user()->group_id;

        if ($teacher_status == 0 && $group < 7){
            $html = '<a href="javascript:void(0)" class="btn btn-sm btn-outline-success btnApprove" data-url="'. url('teacher/approve/'. $teacher_nik).'" data-toggle="tooltip" data-placement="top" title="Setujui">
                         <i class="fas fa-check"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-outline-warning btnReset" data-url="'. url('teacher/reset/'. $teacher_nik).'" data-toggle="tooltip" data-placement="top" title data-original-title="Atur Ulang Kata Sandi">
                            <i class="fas fa-key"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-outline-default btnEdit" data-id="'.$teacher_nik .'" data-toggle="tooltip" data-placement="top" title data-original-title="Ubah">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger btnDelete" data-url="'. url('teacher/delete/'. $teacher_nik).'" data-toggle="tooltip" data-placement="top" title data-original-title="Hapus">
                        <i class="fas fa-trash-alt"></i>
                        </a>';
        }else{
            $html = '<a href="javascript:void(0)" class="btn btn-sm btn-outline-warning btnReset" data-url="'. url('teacher/reset/'. $teacher_nik).'" data-toggle="tooltip" data-placement="top" title data-original-title="Atur Ulang Kata Sandi">
                        <i class="fas fa-key"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-outline-default btnEdit" data-id="'.$teacher_nik .'" data-toggle="tooltip" data-placement="top" title data-original-title="Ubah">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger btnDelete" data-url="'. url('teacher/delete/'. $teacher_nik).'" data-toggle="tooltip" data-placement="top" title data-original-title="Hapus">
                    <i class="fas fa-trash-alt"></i>
                    </a>';
        }       
        
        return $html;
    }

}