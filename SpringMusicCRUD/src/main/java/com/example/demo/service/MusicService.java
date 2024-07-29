package com.example.demo.service;

import com.example.demo.entity.Music;

public interface MusicService {
	Iterable<Music> findAll();
	
	void insertMusic(Music music);
	
	
	//void deleteMusic(Music music);
	
	Music findById(Integer id);
	
	void updateMusic(Music music);
	
	void deleteMusic(Integer id);

}
