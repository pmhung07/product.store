<?php
namespace Nht\Hocs\Core\Metadata;

use Modules\Setting\Repositories\Setting;
use Modules\Setting\Repositories\SettingRepository;

class Metadata {

	public function __construct(SettingRepository $set) {
		if($setting = $set->find(1)) {
			$dbSetting = \DB::select('SHOW FIELDS FROM settings');
			foreach ($dbSetting as $set) {
				$field        = $set->Field;
				$this->$field = $setting->$field;
			}
		}
	}

	public function setTitle($title) {
		$this->name = $title;
		return $this;
	}

	public function getTitle() {
		return $this->name;
	}

	public function setLogo($logo) {
		$this->logo = $logo;
		return $this;
	}

	public function getLogo() {
		return $this->logo;
	}

	public function setAddress($address) {
		$this->address = $address;
		return $this;
	}

	public function getAddress() {
		return $this->address;
	}

	public function setEmail_1($email) {
		$this->email_1 = $email;
		return $this;
	}

	public function getEmail_1() {
		return $this->email_1;
	}

	public function setPhone_1($phone) {
		$this->phone_1 = $phone;
		return $this;
	}

	public function getPhone_1() {
		return $this->phone_1;
	}

	public function getHotLine() {
		return $this->hotline;
	}

	public function setSkype_1($skype) {
		$this->skype_1 = $skype;
		return $this;
	}

	public function getSkype_1() {
		return $this->skype_1;
	}

	public function setShortDescription($description) {
		$this->short_description = $description;
		return $this;
	}

	public function getShortDescription() {
		return $this->short_description;
	}

	public function setDescription($description) {
		$this->description = $description;
		return $this;
	}

	public function getDescription() {
		return $this->description;
	}

	public function setContact($contact) {
		$this->contact = $contact;
		return $this;
	}

	public function getContact() {
		return $this->contact;
	}

	public function setMetaTitle($meta_title) {
		$this->meta_title = $meta_title;
		return $this;
	}

	public function getMetaTitle() {
		return $this->meta_title;
	}

	public function setMetaKeyword($meta_keyword) {
		$this->meta_keyword = $meta_keyword;
		return $this;
	}

	public function getMetaKeyword() {
		return $this->meta_keyword;
	}

	public function setMetaDescription($meta_description) {
		$this->meta_description = $meta_description;
		return $this;
	}

	public function getMetaDescription() {
		return $this->meta_description;
	}

	public function setJsCodes($js_codes) {
		$this->js_codes = $js_codes;
		return $this;
	}

	public function getJsCodes() {
		return $this->js_codes;
	}

	public function setFacebook($facebook) {
		$this->facebook = $facebook;
		return $this;
	}

	public function getFacebook() {
		return $this->facebook;
	}

	public function setGoogleplus($googleplus) {
		$this->googleplus = $googleplus;
		return $this;
	}

	public function getGoogleplus() {
		return $this->googleplus;
	}

	public function setTwitter($twitter) {
		$this->twitter = $twitter;
		return $this;
	}

	public function getTwitter() {
		return $this->twitter;
	}

	public function setLinkin($linkin) {
		$this->linkin = $linkin;
		return $this;
	}

	public function getLinkin() {
		return $this->linkin;
	}

	public function setYoutube($youtube) {
		$this->youtube = $youtube;
		return $this;
	}

	public function getYoutube() {
		return $this->youtube;
	}

	public function getLinkStream() {
		return $this->link_stream;
	}

	public function getPinterest()
	{
		return $this->pinterest;
	}

	public function getInstagram()
	{
		return $this->instagram;
	}

	public function getTumblr()
	{
		return $this->tumblr;
	}

}