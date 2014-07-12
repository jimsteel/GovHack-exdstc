package org.govhack.rf;

import java.io.IOException;
import java.util.ArrayDeque;
import java.util.Deque;
import java.util.Iterator;

import org.apache.poi.hssf.usermodel.HSSFSheet;
import org.apache.poi.hssf.usermodel.HSSFWorkbook;
import org.apache.poi.ss.usermodel.Cell;

import com.google.gson.Gson;
import com.google.gson.GsonBuilder;

/**
 * @author ametke
 *
 */
public class ExcelToJson {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		
		try {
			HSSFWorkbook workbook = new HSSFWorkbook(ExcelToJson.class.getClassLoader().getResourceAsStream("sri_table3.xls"));
			HSSFSheet sheet = workbook.getSheetAt(0);
			
			Model m = new Model();
			

			Iterator<org.apache.poi.ss.usermodel.Row> rowIterator = sheet.iterator();
			
			while(rowIterator.hasNext()) {
				org.apache.poi.ss.usermodel.Row r = rowIterator.next();
				String label = r.getCell(0).getStringCellValue().trim();
				if(label.startsWith("_2")) label = label.substring(2);
				
				// Test if it has data
				if(r.getCell(1).getCellType() != Cell.CELL_TYPE_BLANK) {
					Row nr = new Row();
					// Get program
					nr.setProgram(label);
					// Get values
					nr.setExp2004_05((float) r.getCell(2).getNumericCellValue());
					nr.setExp2005_06((float) r.getCell(3).getNumericCellValue());
					nr.setExp2006_07((float) r.getCell(4).getNumericCellValue());
					nr.setExp2007_08((float) r.getCell(5).getNumericCellValue());
					nr.setExp2008_09((float) r.getCell(6).getNumericCellValue());
					nr.setExp2009_10((float) r.getCell(7).getNumericCellValue());
					nr.setExp2010_11((float) r.getCell(8).getNumericCellValue());
					nr.setExp2011_12((float) r.getCell(9).getNumericCellValue());
					nr.setExp2012_13((float) r.getCell(10).getNumericCellValue());
					nr.setExp2013_14((float) r.getCell(11).getNumericCellValue());
					
					m.getRows().add(nr);
				}
			}
			
			rowIterator = sheet.iterator();
			
			Deque<String> parents = new ArrayDeque<>();
			parents.add("root");
			
			while(rowIterator.hasNext()) {
				org.apache.poi.ss.usermodel.Row r = rowIterator.next();
				String label = r.getCell(0).getStringCellValue().trim();
				
				if(r.getCell(1).getCellType() == Cell.CELL_TYPE_BLANK) {
					m.getEdgeList().add(new EdgePair(parents.peekLast(), ExcelToJson.formatLabel(label)));
					parents.add(ExcelToJson.formatLabel(label));
				} else if(label.startsWith("_2")) {
					m.getEdgeList().add(new EdgePair(parents.peekLast(), ExcelToJson.formatLabel(label)));
					parents.removeLast();
				} else {
					m.getEdgeList().add(new EdgePair(parents.peekLast(), ExcelToJson.formatLabel(label)));
				}
			}
			
			System.out.println("Parents should be size 1: "+ parents.size() + "("+parents.getLast()+")");
			//System.out.println(m);
			
			Gson gson = new GsonBuilder().setPrettyPrinting().create();
			System.out.println(gson.toJson(m));
			
		} catch (IOException e) {
			e.printStackTrace();
		}

	}
	
	public static String formatLabel(String label) {
		if(label.startsWith("_2")) return label.substring(2);
		else return label;
	}

}
