import os
import shutil

def files_organizer(directory, extension1, extension2, extension3, extension4, directory1, directory2):
    """
    Esta función verifica la existencia de un lote de archivos con extensión *.CPLAN2, *SETPARA2, *OK, *.RECEIVETASK en el directorio local. 
    En caso de existir, debe ser capaz de mover los archivos de extensiones *.CPLAN2, *SETPARA2, *OK a un directorio1 especifico y los *.RECEIVETASK a otro directorio2 especifico.
     Args:
        directory: El directorio local donde se encuentran los archivos.
        extension1: La extensión de los archivos que se deben mover al directorio1.
        extension2: La extensión de los archivos que se deben mover al directorio2.
        extension3: La extensión de los archivos que se deben mover al directorio1.
        extension4: La extensión de los archivos que se deben mover al directorio2.
        directory1: El directorio donde se deben mover los archivos con extensión *.CPLAN2, *SETPARA2, *OK.
        directory2: El directorio donde se deben mover los archivos con extensión *.RECEIVETASK.
    """
    # Verificamos si el directorio existe.
    if not os.path.exists(directory):
        raise FileNotFoundError("El directorio {} no existe.".format(directory))
     # Obtenemos una lista con los archivos del directorio.
    files = os.listdir(directory)
     # Filtramos los archivos por extensión.
    cplan2_files = [file for file in files if file.endswith(extension1)]
    setpara2_files = [file for file in files if file.endswith(extension2)]
    ok_files = [file for file in files if file.endswith(extension3)]
    receivetask_files = [file for file in files if file.endswith(extension4)]
     # Movemos los archivos a los directorios correspondientes.
    for file in cplan2_files:
        shutil.copy(os.path.join(directory, file), directory1)
    for file in setpara2_files:
        shutil.copy(os.path.join(directory, file), directory1)
    for file in ok_files:
        shutil.copy(os.path.join(directory, file), directory1)
    for file in receivetask_files:
        shutil.copy(os.path.join(directory, file), directory2)

    for file in files:
        if file.endswith(extension1) or file.endswith(extension2) or file.endswith(extension3) or file.endswith(extension4):
            os.remove(file)