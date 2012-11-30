		<div id="right">

			<div class="section">
				<div class="box">
					<div class="title">
						Inputs and textareas
						<span class="hide"></span>
					</div>
					<div class="content">
						<form action="">
							<div class="row">
								<label>Normal input</label>
								<div class="right"><input type="text" value="" /></div>
							</div>
							<div class="row">
								<label>Password input</label>
								<div class="right"><input type="password" value="" /></div>
							</div>
							<div class="row">
								<label>Placeholder input</label>
								<div class="right"><input type="text" value="" placeholder="Here some text" /></div>
							</div>
							<div class="row">
								<label>Readonly input</label>
								<div class="right"><input type="text" readonly="readonly" value="Here some text" /></div>
							</div>
							<div class="row">
								<label>Max lenght input</label>
								<div class="right"><input type="text" maxlength="25" value="" placeholder="Max. 25 characters..." /></div>
							</div>
							<div class="row">
								<label>Textarea</label>
								<div class="right"><textarea rows="" cols="" style="height : 100px;"></textarea></div>
							</div>
							<div class="row">
								<label>Textarea auto grow</label>
								<div class="right"><textarea rows="" cols="" class="grow" placeholder="This textarea is going to grow when you fill it with text." style="height : 100px;"></textarea></div>
							</div>
						</form>
					</div>
				</div>
			</div>
			
			<div class="section">
				<div class="box">
					<div class="title">
						Form validation
						<span class="hide"></span>
					</div>
					<div class="content">
						<form action="" class="valid">
							<div class="row">
								<label>Normal input</label>
								<div class="right"><input type="text" value="" name="name" class="{validate:{required:true, messages:{required:'Please enter your name'}}}" /></div>
							</div>
							<div class="row">
								<label>Email</label>
								<div class="right"><input type="text" value="" name="email" class="{validate:{required:true, email:true, messages:{required:'Please enter your email address'}}}" /></div>
							</div>
							<div class="row">
								<label>Textarea</label>
								<div class="right"><textarea rows="8" cols="" name="message" class="{validate:{required:true, messages:{required:'Please enter a message'}}}"></textarea></div>
							</div>
							<div class="row">
								<label>Buttons</label>
								<div class="right">
									<button type="submit"><span>Click me</span></button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			
			<div class="section">
				<div class="box">
					<div class="title">
						Inputs with filtering
						<span class="hide"></span>
					</div>
					<div class="content">
						<form action="">
							<div class="row">
								<label>Only text input</label>
								<div class="right"><input type="text" value="" placeholder="class='onlytext'" class="onlytext" /></div>
							</div>
							<div class="row">
								<label>Lowercase input</label>
								<div class="right"><input type="text" value="" placeholder="class='onlylow'" class="onlylow" /></div>
							</div>
							<div class="row">
								<label>Uppercase input</label>
								<div class="right"><input type="text" value="" placeholder="class='onlyup'" class="onlyup" /></div>
							</div>
							<div class="row">
								<label>Number input</label>
								<div class="right"><input type="text" value="" placeholder="class='onlynum'" class="onlynum" /></div>
							</div>
							<div class="row">
								<label>URL safe input</label>
								<div class="right"><input type="text" value="" placeholder="class='onlyurl'" class="onlyurl" /></div>
							</div>
						</form>
					</div>
				</div>
			</div>
			
			<div class="section">
				<div class="box">
					<div class="title">
						Selectmenus and spinners
						<span class="hide"></span>
					</div>
					<div class="content">
						<form action="">
							<div class="row">
								<label>Small selectmenu</label>
								<div class="right">
									<select class="small">
										<option selected="selected" value="">2012</option>
										<option value="">2011</option>
										<option value="">2010</option>
										<option value="">2009</option>
										<option value="">2008</option>
										<option value="">2007</option>
									</select>
								</div>
							</div>
							<div class="row">
								<label>Normal selectmenu</label>
								<div class="right">
									<select>
										<option selected="selected" value="">The selected one.</option>
										<option value="">Option number 1</option>
										<option value="">Option number 2</option>
										<option value="">Option number 3</option>
										<option value="">Option number 4</option>
										<option value="">Option number 5</option>
									</select>
								</div>
							</div>
							<div class="row">
								<label>Big selectmenu</label>
								<div class="right">
									<select class="big">
										<option selected="selected" value="">The selected one.</option>
										<option value="">Option number 1</option>
										<option value="">Option number 2</option>
										<option value="">Option number 3</option>
										<option value="">Option number 4</option>
										<option value="">Option number 5</option>
									</select>
								</div>
							</div>
							<div class="row">
								<label>Multi select</label>
								<div class="right">
									<select multiple="multiple" size="5" class="multiple">
										<option value="">Option number 1</option>
										<option value="">Option number 2</option>
										<option selected="selected" value="">Option number 3</option>
										<option value="">Option number 4</option>
										<option value="">Option number 5</option>
										<option selected="selected" value="">Option number 6</option>
										<option value="">Option number 7</option>
										<option value="">Option number 8</option>
										<option value="">Option number 9</option>
										<option value="">Option number 10</option>
									</select>
								</div>
							</div>
							<div class="row">
								<label>Normal spinner</label>
								<div class="right">
									<input type="text" class="spin" value="10" />
								</div>
							</div>
							
							<div class="row">
								<label>Decimal spinner</label>
								<div class="right">
									<input type="text" class="spin-dec" value="15.25" />
								</div>
							</div>
							
							<div class="row">
								<label>Currency spinner</label>
								<div class="right">
									<input type="text" class="spin-cur" value="1.00" />
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			
			<div class="section">
				<div class="box">
					<div class="title">
						Checkboxes, radiobuttons and file upload
						<span class="hide"></span>
					</div>
					<div class="content">
						<form action="">
							<div class="row">
								<label>Checkboxes</label>
								<div class="right">
									<input type="checkbox" name="" value="" id="first-check" checked="checked" />
									<label for="first-check">Check on</label>
									
									<input type="checkbox" name="" value="" id="second-check" />
									<label for="second-check">Check off</label>
								</div>
							</div>
							<div class="row">
								<label>Radiobuttons</label>
								<div class="right">
									<input type="radio" name="radiobutton" id="radio-1" checked="checked" /> 
									<label for="radio-1">Radio on</label>
									
									<input type="radio" name="radiobutton" id="radio-2" /> 
									<label for="radio-2">Radio off</label>
								</div>
							</div>
							<div class="row">
								<label>File upload</label>
								<div class="right"><input type="file" /></div>
							</div>
						</form>
					</div>
				</div>
			</div>
			
			<div class="section">
				<div class="box">
					<div class="title">
						Datepicker and buttons
						<span class="hide"></span>
					</div>
					<div class="content">
						<form action="">
							<div class="row">
								<label>Datepicker</label>
								<div class="right"><input type="text" class="datepicker" placeholder="mm.dd.yyyy" /></div>
							</div>
							<div class="row">
								<label>Datepicker inline</label>
								<div class="right"><div class="datepicker"></div></div>
							</div>
							<div class="row">
								<label>Buttons</label>
								<div class="right">
									<button type="submit"><span>Sumbit</span></button>
									<button type="submit" class="green"><span>Sumbit</span></button>
									<button type="submit" class="blue"><span>Sumbit</span></button>
									<button type="submit" class="red"><span>Sumbit</span></button>
									<button type="submit" class="orange"><span>Sumbit</span></button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			
			<div class="section">
				<div class="box">
					<div class="title">
						WYSIWYG
						<span class="hide"></span>
					</div>
					<div class="content nopadding">
						<form action="">
								<textarea rows="" cols="" class="wysiwyg" style="height : 100px;"></textarea>
						</form>
					</div>
				</div>
			</div>
			
		</div>
		
	</div>
</div>
