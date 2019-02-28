<h6>Vista _paginacion</h6>

		<?php if(($this->_paginacion)): ?>

			<?php if(($this->_paginacion['primero'])): ?>
				<a href="<?php echo $link . $this->_paginacion['primero']; ?>">PRIMERO</a>
			<?php else: ?>
				Primero
			<?php endif; ?>

			&nbsp;
		
			<?php if(($this->_paginacion['anterior'])): ?>
				<a href="<?php echo $link . $this->_paginacion['anterior']; ?>">ANTERIOR</a>
			<?php else: ?>
				Anterior
			<?php endif; ?>

			&nbsp;

			<?php //rango de páginas entre anterior y siguiente ?>
		
			<?php for($i = 0; $i < count($this->_paginacion['rango']); $i++): ?>
		
				<?php if($this->_paginacion['actual'] == $this->_paginacion['rango'][$i]): ?>
		
					<span><?php echo $this->_paginacion['rango'][$i]; ?></span>
				
				<?php else: ?>
		
						
							<a href="<?php echo $link . $this->_paginacion['rango'][$i]; ?>">
								<?php echo $this->_paginacion['rango'][$i]; ?>
							</a>
							&nbsp;
						
		
				<?php endif; ?>
		
			<?php endfor; ?>

			&nbsp;
		
			<?php if(($this->_paginacion['siguiente'])): ?>
				<a href="<?php echo $link . $this->_paginacion['siguiente']; ?>">SIGUIENTE</a>
			<?php else: ?>
				Siguiente
			<?php endif; ?>

			&nbsp;
		
			<?php if(($this->_paginacion['ultimo'])): ?>
				<a href="<?php echo $link . $this->_paginacion['ultimo']; ?>">ULTIMO</a>
			<?php else: ?>
				Ultimo
			<?php endif; ?>

	<?php endif; ?>
