<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\OurFunction;

class OurContoller extends Controller
{
   	Public function create(Request $request) {
   		if(empty($request->nama) OR empty($request->jabatan) OR empty($request->umur) OR empty($request->alamat) OR empty($request->foto)) {
   			return response()->json(array("success" => false, "message" => "Field cannot be blank"));
   		} else {
   			$add = new OurFunction();
   			$add->nama = $request->nama;
   			$add->jabatan = $request->jabatan;
   			$add->umur = $request->umur;
   			$add->alamat = $request->alamat;
   			$add->foto = $request->foto;
   			if($add->save()) {
   				return response()->json(array("success" => true, "message" => "Karyawan has been added", "karyawan_id" => $add->id));
   			} else {
    			return response()->json(array("success" => false, "message" => "Terjadi kesalahan"));  				
   			}
   		}
   	}

   	Public function delete(Request $request) {
   		if(empty($request->id)) {
   		   	return response()->json(array("success" => false, "message" => "Field cannot be blank"));
   		} else {
   			$delete = OurFunction::find($request->id);
   			if($delete) {
   				if($delete->delete()) {
   					  return response()->json(array("success" => true, "message" => "Karyawan telah dihapus"));	
   				} else {
    				  return response()->json(array("success" => false, "message" => "Terjadi kesalahan"));  				
   				}
   			} else {
   				return response()->json(array("success" => false, "message" => "Karyawan tidak ditemukan"));
   			}
   		}
   	}

   	Public function update(Request $request) {
   		if(empty($request->id)) {
   		   	return response()->json(array("success" => false, "message" => "Field cannot be blank"));	   			
   		} else {
   			$update = OurFunction::find($request->id);
   			if($update) {
   				if(!empty($request->nama)) {
   					$update->nama = $request->nama;
   				} else if(!empty($request->jabatan)) {
   					$update->jabatan = $request->jabatan;
   				} else if(!empty($request->umur)) {
   					$update->umur = $request->umur;
   				} else if(!empty($request->alamat)) {
   					$update->alamat = @$request->alamat;
   				} else if(!empty($request->foto)) {
   					$update->foto = $request->foto;
   				}
   				if($update->save()) {
   				   return response()->json(array("success" => true, "message" => "Karyawan telah diupdate"));	
   				} else {
   	    		   return response()->json(array("success" => false, "message" => "Terjadi kesalahan"));							
   				}
   			} else {
   				return response()->json(array("success" => false, "message" => "Karyawan tidak ditemukan"));	
   			}
   		}
   	}

   	Public function read(Request $request) {
   		if(empty($request->id)) {
   		   	return response()->json(array("success" => false, "message" => "Field cannot be blank"));	   			
   		} else {
   			$read = OurFunction::find($request->id);
   			if($read) {
   				return response()->json(array("success" => true, "data" => array("nama" => $read->nama, "jabatan" => $read->jabatan, "umur" => $read->umur, "alamat" => $read->alamat, "foto" => $read->foto)));
   			} else {
   	    		return response()->json(array("success" => false, "message" => "Karyawan tidak ditemukan"));  								
   			}
   		}
   	}
}
