package com.example.demo.controller;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestParam;

import com.example.demo.entity.Music;
import com.example.demo.form.MusicForm;
import com.example.demo.service.MusicService;

@Controller
public class MusicController {

	@Autowired
	MusicService service;
	
	@GetMapping("index")
	public String indexView() {
		return "index";
	}
	
	@PostMapping(value="dbselect", params="select" )
	public String listView(Model model) {
		Iterable<Music> list = service.findAll();
		model.addAttribute("list", list);
		return "list";
	}
	
	@PostMapping(value="dbselect", params="insert")
	public String musicInputView(){
		return "insert";
	}
	
	@PostMapping("insert")
	public String musicConfirmView(MusicForm m) {
		Music music = new Music(
				m.getSong_id(),
				m.getSong_name(),
				m.getSinger()
				);
		service.insertMusic(music);
		return "complete";
	}
	
	@PostMapping(value="dbselect", params="update")
	public String musicUpdateView(
	        @RequestParam("song_id") Integer song_id, 
	        Model model
	) {
	    Music music = service.findById(song_id);
	    model.addAttribute("music", music);
	    return "update";
	}

	@PostMapping("/update")
	public String updateMusic(
	        @RequestParam("song_id") Integer song_id,
	        @RequestParam("song_name") String song_name,
	        @RequestParam("singer") String singer,
	        MusicForm m
	) {
	    Music music = service.findById(song_id);
	    
	    if (music != null) {
	        music.setSong_name(song_name);
	        music.setSinger(singer);
	        service.updateMusic(music);
	    }
	    return "redirect:/index";
	}

	
	@PostMapping(value="dbselect", params="delete")
	public String deleteMusic(
	        @RequestParam("song_id") Integer song_id
	) {
	    service.deleteMusic(song_id);
	    return "deletecomp";
	}


	
	
}
